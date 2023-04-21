<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Form\PhotoFormType;
use App\Form\PhotoUpFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class PhotosController extends AbstractController
{
    #[Route('/photos', name: 'app_photos')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $photo = new Photos();

        $form = $this->createForm(PhotoFormType::class, $photo);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($photo);
            $entityManager->flush();


            return $this->render('home/home.html.twig', [
                'message' => 'Le nombre maximum de place a été modifiées avec succès',
                'alert' => 'success',
            ]);
        }

        return $this->render('page/photoUpload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('admin/photosList', name: 'app_photos_list')]
    public function paramsHours(EntityManagerInterface $entityManager, Request $request): Response
    {
        $photosList = $entityManager->getRepository(Photos::class)->findAll();

        // Retourner la vue avec les données
        return $this->render('page/photoList.html.twig', [
            'photos_list' => $photosList
        ]);
    }

    #[Route('admin/photo/edit/{id}', name: 'edit_photo')]
    public function editPhoto(Photos $photo, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PhotoUpFormType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $nouveauFichierImage = $form->get('imageFile')->getData();
                if ($nouveauFichierImage) {
                    $photo->setImageFile($nouveauFichierImage);
                } else {
                    $photo->setImage($photo->getImageFile());
                }

                $entityManager->flush();

                return $this->redirectToRoute('app_home', [
                    'message' => 'La photo a été modifiée avec succès',
                    'alert' => 'success',
                ]);
            } catch (\Exception $e) {
                return $this->render('home/home.html.twig', [
                    'message' => 'Une erreur est survenue lors de la modification de la photo',
                    'alert' => 'danger',
                ]);
            }
        }

        return $this->render('page/photoUpdate.html.twig', [
            'form' => $form->createView(),
            'photo' => $photo
        ]);
    }

    #[Route('/photo/delete/{id}', name: 'delete_photo')]
    public function deletePhoto(Request $request, Photos $photo, EntityManagerInterface $entityManager)
    {

        if (!$photo) {
            throw $this->createNotFoundException('Photo non trouvée');
        }


        $photoPath = $this->getParameter('vich_uploader.upload_destination') . $photo->getImageName();
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }


        $entityManager->remove($photo);
        $entityManager->flush();


        $this->addFlash('success', 'La photo a été supprimée avec succès.');
        return $this->redirectToRoute('app_photos_list');
    }

}
