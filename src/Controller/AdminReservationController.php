<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\ReservationLink;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[IsGranted("ROLE_ADMIN")]
class AdminReservationController extends AbstractController
{
    #[Route('/admin/reservation', name: 'app_admin_reservation')]
    public function index(): Response
    {
        return $this->render('page/adminReservation.html.twig', [
            'controller_name' => 'AdminReservationController',
        ]);
    }

    #[Route('admin/reservation/hours', name: 'app_admin_reservation_hours')]
    public function reservationHours(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $dateString = $request->get('date');
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $dateString);
        $service = $request->get('service');


        $reservation = $entityManager
            ->getRepository(Reservation::class)
            ->findOneBy(['date' => $date, 'service' => $service]);

        if ($reservation == null){
            return new JsonResponse(['status' => 'error', 'error' => 'Aucune réservation trouvée.']);
        }else {
            $reservationLinks = $entityManager
                ->getRepository(ReservationLink::class)
                ->findBy(['reservation_id' => $reservation->getId()]);



            $data = [];
            foreach ($reservationLinks as $link) {
                $data[] = [
                    'id' => $link->getId(),
                    'numberSeat' => $link->getNumberSeat(),
                    'allergen' => $link->getAllergen(),
                    'name' => $link->getName(),
                    'hour' => $link->getHour()->format('H:i'),
                ];
            }



            if ($data == []){
                return new JsonResponse(['status' => 'error', 'error' => 'Aucune réservation trouvée.']);
            } else{
                return new JsonResponse(['status' => 'success', 'data' => $data]);
            }

        }
    }




}
