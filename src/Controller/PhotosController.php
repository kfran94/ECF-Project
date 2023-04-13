<?php

namespace App\Controller;

use App\Entity\Photos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class PhotosController extends AbstractController
{
    #[Route('/photos', name: 'app_photos')]
    public function index(): Response
    {

        return $this->render('page/photoUpload.html.twig', [
            'controller_name' => 'PhotosController',
        ]);
    }
    #[Route('/upload/photo', name: 'upload_photo', methods: ['POST'])]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $photoFile = $request->files->get('photoFile');

        if ($photoFile) {
            // Spécifier le répertoire de destination
            $uploadDirectory = './public/media/upload';
            $fileName = md5(uniqid()) . '.' . $photoFile->guessExtension();
            $photoFile->move($uploadDirectory, $fileName);

            // Gérer le fichier uploadé
            $name = $photoFile->getClientOriginalName();
            $size = $photoFile->getSize();
            $type = $photoFile->getClientMimeType();

            // Créer une nouvelle entité Photo
            $photo = new Photos();
            $photo->setName($name);
            $photo->setSize($size);
            $photo->setType($type);
            $photo->setPath($uploadDirectory . '/' . $fileName);

            // Sauvegarder la photo en base de données
            $entityManager->persist($photo);
            $entityManager->flush();

            // Rediriger vers une page de succès
            return $this->redirectToRoute('home.home.html.twig');
        }

        // Rediriger vers une page d'erreur si aucun fichier n'a été uploadé
        return $this->redirectToRoute('error_page');
    }

}
