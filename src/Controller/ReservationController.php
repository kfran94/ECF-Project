<?php

namespace App\Controller;


use App\Entity\OpeningHours;
use App\Entity\Reservation;
use App\Entity\ReservationLink;
use App\Entity\SeatMax;
use App\Form\ReservationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeImmutableToDateTimeTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index()
    {
        return $this->render('page/reservation.html.twig');
    }

    #[Route('/reservation/form', name: 'app_reservation_form', methods: ['GET', 'POST'])]
    public function form(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dateString = $request->request->get('date');
        $date = new \DateTime($dateString);

        $service = $request->request->get('service');

        // Vérifier si une entrée existe déjà pour cette date et ce service
        $reservation = $entityManager
            ->getRepository(Reservation::class)
            ->findOneBy(['date' => $date, 'service' => $service]);

        // Si aucune entrée n'existe, créer une nouvelle réservation
        if (!$reservation) {
            $reservation = new Reservation();
            $reservation->setDate($date);
            $reservation->setService($service);


            $entityManager->persist($reservation);
            $entityManager->flush();
        }

        // Vérifier la disponibilité des places pour cette réservation
        $reservationLinkId = $reservation->getId();
        $reservationLinkRepo = $entityManager->getRepository(ReservationLink::class);
        $reservationsLinks = $reservationLinkRepo->findBy(['reservation_id' => $reservationLinkId]);

        $availableSeats = 0;
        foreach ($reservationsLinks as $reservationLink) {
            $availableSeats += $reservationLink->getNumberSeat();

        }

        // Récupérer le nombre de places maximum pour ce service
        $seatMaxRepo = $entityManager->getRepository(SeatMax::class);
        $seatMax = $seatMaxRepo->findOneBy(['id' => 1]);
        $totalSeats = $seatMax->getMaxSeat();

        // Vérifier s'il reste des places disponibles
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
        } else return $this->render('page/reservation.html.twig', [
            'message' => "Désolé, nous sommes fermés pour ce service. Veuillez choisir une autre date ou un autre service.",
            'alert' => 'danger',
        ]);


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
            return $this->render('page/reservation.html.twig', [
                'message' => "Désolé, nous sommes complets pour ce service. Veuillez choisir une autre date ou un autre service.",
                'alert' => 'danger',
            ]);
        } else {

            $user = $this->getUser();

            $defaultName = $user ? $user->getName() : " ";
            $defaultAllergies = $user ? $user->getAllergen() : " ";
            var_dump($defaultName);

            $reservationForm = $this->createForm(ReservationFormType::class, null, [
                'action' => $this->generateUrl('app_make_reservation', ['id' => $reservation->getId()]),
                'method' => 'POST',
                'available_seats' => $remainingSeats,
                'available_times' => $availableTimes,
                'default_name' => $defaultName,
                'default_allergies' => $defaultAllergies,
            ]);


        }
        return $this->render('page/reservation_form.html.twig', [
            'reservation_form' => $reservationForm->createView(),
            'available_seats' => $remainingSeats,
            'available_times' => $availableTimes,


        ]);
    }

    #[Route('/reservation/make/{id}', name: 'app_make_reservation')]
    public function makeReservation(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);


        $dateString = $_POST['reservation_form']['time'];
        $date = date_create_from_format('H:i', $dateString);

        $reservationLink = new ReservationLink();
        $reservationLink->setReservationId($reservation);
        $reservationLink->setName($_POST['reservation_form']['name']);
        $reservationLink->setHour($date);
        $reservationLink->setNumberSeat($_POST['reservation_form']['number_of_seats']);
        $reservationLink->setAllergen($_POST['reservation_form']['allergies']);

        $entityManager->persist($reservationLink);
        $entityManager->flush();

        return $this->render('home/home.html.twig', [
            'message' => "Réservation effectuée.",
            'alert' => 'success',
        ]);
    }

}
