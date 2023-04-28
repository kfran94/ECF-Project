<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\MenuLinkDish;
use App\Entity\Photos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/carte', name: 'app_menu_carte')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $dishes = $entityManager->getRepository(Dish::class)->findAll();
        $menus = $entityManager->getRepository(Menu::class)->findAll();
        $menuLinkDishes = $entityManager->getRepository(MenuLinkDish::class)->findAll();
        $limit = count($menus);
        $allPhotos = $entityManager->getRepository(Photos::class)->findAll();
        $count = count($allPhotos);

        $selectedPhotos = [];
        for ($i = 0; $i < $limit; $i++) {
            do {
                $index = rand(0, $count - 1);
            } while (in_array($index, $selectedPhotos));
            $selectedPhotos[] = $index;
        }
        $result = [];
        foreach ($selectedPhotos as $index) {
            $result[] = $allPhotos[$index];
        }

        return new Response(
            $this->render('page/menuCarte.html.twig', [
                'dishes' => $dishes,
                'menus' => $menus,
                'menuLinkDishes' => $menuLinkDishes,
                'photos' => $result
            ])
        );
    }
}
