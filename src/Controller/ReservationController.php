<?php

namespace App\Controller;


use App\Entity\OpeningHours;
use App\Entity\Reservation;
use App\Entity\ReservationLink;
use App\Entity\SeatMax;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index()
    {
        return $this->render('page/reservation.html.twig');
    }

    #[Route('/reservation/getHours', name: 'app_reservation_hours')]
    public function getHours(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $dateString = $request->get('date');
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $dateString);
        $service = $request->get('service')
       ;



        $reservation = $entityManager
            ->getRepository(Reservation::class)
            ->findOneBy(['date' => $date, 'service' => $service]);

        if ($reservation == null) {

            $reservation = new Reservation();
            $reservation->setDate($date);
            $reservation->setService($service);


            $entityManager->persist($reservation);
            $entityManager->flush();
        }
        $reservation = $entityManager->getRepository(Reservation::class)->findOneBy(['date' => $date, 'service' => $service]);


        $reservationLinkId = $reservation->getId();
        $reservationLinkRepo = $entityManager->getRepository(ReservationLink::class);
        $reservationsLinks = $reservationLinkRepo->findBy(['reservation_id' => $reservationLinkId]);

        $availableSeats = 0;
        foreach ($reservationsLinks as $reservationLink) {
            $availableSeats += $reservationLink->getNumberSeat();

        }


        $seatMaxRepo = $entityManager->getRepository(SeatMax::class);
        $seatMax = $seatMaxRepo->findOneBy(['id' => 1]);
        $totalSeats = $seatMax->getMaxSeat();


        $remainingSeats = $totalSeats - $availableSeats;
        $dayOfWeek = $date->format('l');
        $translat = array(
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche'
        );
        foreach ($translat as $en => $fr) {
            if ($dayOfWeek === $en) {
                $dayOfWeek = $fr;
                break;
            }
        }

        $openingHoursRepo = $entityManager->getRepository(OpeningHours::class);
        $openingHours = $openingHoursRepo->findOneBy(['day' => $dayOfWeek]);

        if ($service == 1) {
            $openingTime = $openingHours->getOpeningHoursMorning();
            $closingTime = $openingHours->getClosingHoursMorning();
        } elseif ($service == 2) {
            $openingTime = $openingHours->getOpeningHoursEvening();
            $closingTime = $openingHours->getClosingHoursEvening();
        }

        $interval = new \DateInterval('PT15M');
        if ($openingTime !== null) {
            $startTime = clone $openingTime;
            $endTime = clone $closingTime;
            $endTime->modify('-1 hour');
        } else {
            $response = array(
                'status' => 'error',
                'error' => "Désolé, nous sommes fermés pour ce service. Veuillez choisir une autre date ou un autre service.",

            );
            return new JsonResponse($response);
        }


        if ($endTime < $startTime) {
            $endTime->modify('+1 day');
        }
        $availableTimes = [];
        $currentTime = $startTime;
        while ($currentTime <= $endTime) {
            $time = $currentTime->format('H:i');
            $availableTimes[$time] = $time;
            $currentTime->add($interval);
        }

        if ($remainingSeats <= 0) {
            $response = array(
                'status' => 'error',
                'error' => "Désolé, nous sommes complets pour ce service. Veuillez choisir une autre date ou un autre service.",
            );
            return new JsonResponse($response);

        } else {

            $user = $this->getUser();

            $defaultName = $user ? $user->getName() : " ";
            $defaultAllergies = $user ? $user->getAllergen() : " ";


            $reservationForm = array(
                'status' => 'success',
                'available_seats' => $remainingSeats,
                'available_times' => $availableTimes,
                'default_name' => $defaultName,
                'default_allergies' => $defaultAllergies,
                'reservation_id' => $reservation->getId()
                );






        }

        return new JsonResponse($reservationForm);
    }



    #[Route('/reservation/make/{id}', name: 'app_make_reservation')]
    public function makeReservation(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);


        $dateString = $request->get('time');
        $date = date_create_from_format('H:i', $dateString);

        $reservationLink = new ReservationLink();
        $reservationLink->setReservationId($reservation);
        $reservationLink->setName($request->get('name'));
        $reservationLink->setHour($date);
        $reservationLink->setNumberSeat($request->get('number_of_seats'));
        $reservationLink->setAllergen($request->get('allergies'));

        $entityManager->persist($reservationLink);
        $entityManager->flush();

        return $this->render('home/home.html.twig', [
            'message' => "Réservation effectuée.",
            'alert' => 'success',
        ]);
    }

}
