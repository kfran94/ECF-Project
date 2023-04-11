<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParamsOpenningController extends AbstractController
{
    #[Route('/params/openning', name: 'app_params_openning')]
    public function index(): Response
    {
        return $this->render('params_openning/index.html.twig', [
            'controller_name' => 'ParamsOpenningController',
        ]);
    }
}
