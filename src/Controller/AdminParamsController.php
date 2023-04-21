<?php

namespace App\Controller;

use App\Entity\SeatMax;
use App\Form\MaxSeatFormType;
use App\Entity\OpeningHours;
use App\Form\OpeningHoursFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminParamsController extends AbstractController
{
    private $security;
    private $doctrine;

    public function __construct(Security $security)
    {
        $this->security = $security;

    }


    #[Route('/admin/params', name: 'app_admin_params')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            // Rediriger vers la page d'accueil avec un message d'erreur
            return $this->render('home/home.html.twig', [
                'message' => 'Vous n\'avez pas les droits pour accéder à cette page',
                'alert' => 'danger',
            ]);
        }
        $seatMax = $entityManager->getRepository(SeatMax::class)->findOneBy([]);


        if (!$seatMax) {
            $seatMax = new SeatMax();
        }

        $form = $this->createForm(MaxSeatFormType::class, $seatMax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Rediriger vers une page de succès
            return $this->render('home/home.html.twig', [
                'message' => 'Le nombre maximum de place a été modifiées avec succès',
                'alert' => 'success',
            ]);
        }

        return $this->render('page/seat.html.twig', [
            'controller_name' => 'AdminParamsController',
            'form' => $form->createView(),
        ]);
    }


    #[Route('/admin/paramsHours', name: 'app_hours_params')]
    public function paramsHours(EntityManagerInterface $entityManager, Request $request): Response
    {
        $openingHours = $entityManager->getRepository(OpeningHours::class)->findAll();

        // Retourner la vue avec les données
        return $this->render('page/hoursParams.html.twig', [
            'opening_hours' => $openingHours
        ]);
    }

    #[Route('admin/paramsHours/edit/{id}', name: 'edit_opening_hours')]
    public function editOpeningHours(OpeningHours $openingHour, Request $request, EntityManagerInterface $entityManager): Response
    {

        // Créez un formulaire pour la modification
        $form = $this->createForm(OpeningHoursFormType::class, $openingHour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Rediriger vers une page de succès
            return $this->render('home/home.html.twig', [
                'message' => 'Les horaires d\'ouverture ont été modifiées avec succès',
                'alert' => 'success',
            ]);
        }

        return $this->render('page/editHours.html.twig', [
            'form' => $form->createView(),
            'openingHour' => $openingHour
        ]);
    }


}
