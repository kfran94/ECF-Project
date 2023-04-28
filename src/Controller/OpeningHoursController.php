<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use App\Entity\SeatMax;
use App\Repository\OpeningHoursRepository;
use App\Repository\SeatMaxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class OpeningHoursController extends AbstractController
{
    private $security;
    private $seatMaxRepository;

    public function __construct(Security $security, SeatMaxRepository $seatMaxRepository)
    {
        $this->security = $security;
        $this->seatMaxRepository = $seatMaxRepository;
    }

    #[Route('/create-opening-hours', name: 'create_opening_hours')]
    public function createOpeningHours(EntityManagerInterface $entityManager, OpeningHoursRepository $openingHoursRepository): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {

            return $this->render('home/home.html.twig', [
                'message' => 'Vous n\'avez pas les droits pour accéder à cette page',
                'alert' => 'danger',
            ]);
        }

        $existingOpeningHours = $openingHoursRepository->findAll();
        if (!empty($existingOpeningHours)) {
            return $this->render('home/home.html.twig', [
                'message' => 'Les horaires et place maximum sont déjà en base de données',
                'alert' => 'danger',
            ]);
        } else {
            $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            foreach ($daysOfWeek as $day) {
                $openingHours = new OpeningHours();
                $openingHours->setDay($day)
                    ->setOpeningHoursMorning(new \DateTime('11:30:00')) // Horaire d'ouverture du matin
                    ->setClosingHoursMorning(new \DateTime('14:30:00')) // Horaire de fermeture du matin
                    ->setOpeningHoursEvening(new \DateTime('18:00:00')) // Horaire d'ouverture du soir
                    ->setClosingHoursEvening(new \DateTime('22:00:00')); // Horaire de fermeture du soir

                $entityManager->persist($openingHours);
            }

            $seatMax = $this->seatMaxRepository->findOneBy([]);
            if (!$seatMax) {
                $seatMax = new SeatMax();
                $seatMax->setMaxSeat(100);
                $entityManager->persist($seatMax);
            }

            $entityManager->flush();

            return $this->render('home/home.html.twig', [
                'message' => 'Création des horaires et du nombre de place max en base de données effectuée',
                'alert' => 'success',
            ]);
        }
    }
}
