<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\MenuLinkDish;
use App\Form\AddDishFormType;
use App\Form\AddMenuFormType;
use App\Form\CompoMenuFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class CarteController extends AbstractController
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/add/dish', name: 'app_add_dish')]
    public function index(Request $request): Response
    {
        $dish = new Dish();
        $form = $this->createForm(AddDishFormType::class, $dish);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($dish);
            $entityManager->flush();

            return $this->render('home/home.html.twig', [
                'message' => 'Le plat a été ajouté avec succès',
                'alert' => 'success',
            ]);
        }

        return $this->render('page/addDish.html.twig', [
            'controller_name' => 'CarteController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add/menu', name: 'app_add_menu')]
    public function addMenu(Request $request): Response
    {
        $menu = new Menu();
        $form = $this->createForm(AddMenuFormType::class, $menu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->render('home/home.html.twig', [
                'message' => 'Le menu a été ajouté avec succès',
                'alert' => 'success',
            ]);
        }

        return $this->render('page/addMenu.html.twig', [
            'controller_name' => 'CarteController',
            'form' => $form->createView(),
        ]);
    }


    #[Route('/admin/menu/edit', name: 'app_menu_edit')]
    public function addLinkMenu(Request $request, EntityManagerInterface $em): Response
    {
        $menuLinkDish = new MenuLinkDish();
        $form = $this->createForm(CompoMenuFormType::class, $menuLinkDish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($menuLinkDish);
            $em->flush();

            return $this->render('page/menuCompo.html.twig', [
                'message' => 'L\'ajout du plat au menu a été effectué avec success ',
                'alert' => 'success',
                'form' => $form->createView()
            ]);
        }

        return $this->render('page/menuCompo.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/menu/deleteLink', name: 'app_menu_delete_link')]
    public function listLink(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menus = $entityManager->getRepository(Menu::class)->findAll();
        $dishes = $entityManager->getRepository(Dish::class)->findAll();
        $menuLinkDishes = $entityManager->getRepository(MenuLinkDish::class)->findAll();


        if ($request->isMethod('POST')) {
            $menuLinkId = $request->request->get('menuLinkId');
            $menuLinkDish = $entityManager->getRepository(MenuLinkDish::class)->find($menuLinkId);

            if ($menuLinkDish) {
                $entityManager->remove($menuLinkDish);
                $entityManager->flush();
                $this->addFlash('success', 'Le lien Menu/Plat a été supprimé avec succès.');
            } else {
                $this->addFlash('error', 'Le lien Menu/Plat n\'a pas été trouvé.');
            }
            $menus = $entityManager->getRepository(Menu::class)->findAll();
            $dishes = $entityManager->getRepository(Dish::class)->findAll();
            $menuLinkDishes = $entityManager->getRepository(MenuLinkDish::class)->findAll();

            return $this->render('page/deleteDishLink.html.twig', [
                'menus' => $menus,
                'dishes' => $dishes,
                'menuLinkDishes' => $menuLinkDishes,
            ]);
        }


        return $this->render('page/deleteDishLink.html.twig', [
            'menus' => $menus,
            'dishes' => $dishes,
            'menuLinkDishes' => $menuLinkDishes
        ]);
    }

    #[Route('/menus/list', name: 'menus_list')]
    public function listMenus(EntityManagerInterface $entityManager): Response
    {
        $menus = $entityManager->getRepository(Menu::class)->findAll();

        return $this->render('page/menuList.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/menu/{id}', name: 'menu_delete')]
    public function menu_delete(Request $request, Menu $menu, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($menu);
        $entityManager->flush();

        return $this->redirectToRoute('menus_list');
    }

    #[Route('/plat/list', name: 'plat_list')]
    public function listPlats(EntityManagerInterface $entityManager): Response
    {
        $plats = $entityManager->getRepository(Dish::class)->findAll();

        return $this->render('page/dishList.html.twig', [
            'plats' => $plats,
        ]);
    }

    #[Route('/plat/{id}', name: 'plat_delete')]
    public function plat_delete(Request $request, Dish $plat, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($plat);
        $entityManager->flush();

        return $this->redirectToRoute('plat_list');
    }

}