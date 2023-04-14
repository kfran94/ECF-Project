<?php

namespace App\Controller;

use App\Entity\Photos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $photos = $entityManager->getRepository(Photos::class)->findAll();

        return $this->render('home/home.html.twig', [
            'photos'=> $photos,
        ]);
    }
}
