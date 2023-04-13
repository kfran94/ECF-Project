<?php

namespace App\Controller;


use App\Entity\OpeningHours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FooterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function hoursFooter(): Response
    {
        $openingHoursRepository = $this->entityManager->getRepository(OpeningHours::class);
        $openingHours = $openingHoursRepository->findBy([], ['id' => 'ASC']);

        return $this->render('includes/footer.html.twig', [
            'openingHours' => $openingHours
        ]);
    }
}

