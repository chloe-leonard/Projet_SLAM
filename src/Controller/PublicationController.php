<?php

namespace App\Controller;

use App\Entity\Hashtag;
use App\Entity\Image;
use App\Entity\Publication;
use App\Entity\Video;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/publication')]
class PublicationController extends AbstractController
{
    #[Route('/', name: 'app_publication_index', methods: ['GET'])]
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_publication_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);

       // $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'utilisateur connecté s'il existe
            $user = $this->getUser();

            if ($user) {
                // Si l'utilisateur est connecté, définir l'IDUtilisateur
                $publication->setIDUtilisateur($user);

                if($form->get('images')->getData() != null){

                    // Assurez-vous d'avoir le bon emplacement pour la création des dossiers
                    $directory = "photo/";

                    $files = $form->get('images')->getData(); // On récupère le fichier
                    $num_image = 1;
                    foreach ($files as $file) {
                        $images = new Image();
                        $images->setIDPublication($publication);
                        $images->setNumImage($num_image);
                        $images->setPhoto("");

                        // Persistez l'entité Image avant de récupérer l'ID de la publication
                        $entityManager->persist($images);

                        // Flush pour s'assurer que l'entité Image est persisté et que l'ID de la publication est attribuée
                        $entityManager->flush();

                        // Obtenez l'ID de la publication après qu'elle a été persisté
                        $publicationId = $publication->getId();

                        // Créez un dossier pour chaque IDPublication s'il n'existe pas encore
                        $publicationDirectory = $directory . $publicationId;
                        if (!file_exists($publicationDirectory)) {
                            mkdir($publicationDirectory, 0777, true); // Créez le dossier avec les permissions nécessaires
                        }

                        // Générez le nom de fichier unique en utilisant le numéro de l'image
                        $filename = $num_image . '.' . $file->guessExtension();

                        // Déplacez le fichier dans le dossier correspondant à la publication
                        $file->move($publicationDirectory, $filename);

                        // Mettez à jour le nom de fichier de l'entité Image
                        $images->setPhoto($filename);

                        // Persistez à nouveau l'entité Image après avoir mis à jour le nom de fichier
                        $entityManager->persist($images);

                        // Incrémentez le numéro de l'image pour la prochaine itération
                        $num_image++;
                    }
                }

                if($form->get('videos')->getData() != null){

                    // Assurez-vous d'avoir le bon emplacement pour la création des dossiers
                    $directory = "videos/";

                    $files = $form->get('videos')->getData(); // On récupère le fichier
                    $num_lien = 1;
                    foreach ($files as $file) {
                        $videos = new Video();
                        $videos->setIDPublication($publication);
                        $videos->setNumLien($num_lien);
                        $videos->setLien("");
                        // Persistez l'entité Image avant de récupérer l'ID de la publication
                        $entityManager->persist($videos);

                        $entityManager->flush();

                        // Obtenez l'ID de la publication après qu'elle a été persisté
                        $publicationId = $publication->getId();

                        // Créez un dossier pour chaque IDPublication s'il n'existe pas encore
                        $publicationDirectory = $directory . $publicationId;
                        if (!file_exists($publicationDirectory)) {
                            mkdir($publicationDirectory, 0777, true); // Créez le dossier avec les permissions nécessaires
                        }

                        // Générez le nom de fichier unique en utilisant le numéro de l'image
                        $filename = $num_lien . '.' . $file->guessExtension();

                        // Déplacez le fichier dans le dossier correspondant à la publication
                        $file->move($publicationDirectory, $filename);

                        // Mettez à jour le nom de fichier de l'entité Image
                        $videos->setLien($filename);

                        // Persistez à nouveau l'entité Image après avoir mis à jour le nom de fichier
                        $entityManager->persist($videos);

                        // Incrémentez le numéro de l'image pour la prochaine itération
                        $num_lien++;
                    }
                }

                // Récupération des hashtags
                $hashtagsData = $form->get('hashtags')->getData();

                // Parcourir les hashtags
                foreach ($hashtagsData as $hashtagData) {
                    // Créer un nouvel objet Hashtag
                    $hashtag = new Hashtag();

                    // Définir les propriétés de l'objet Hashtag
                    $hashtag->setNom($hashtagData);
                    $hashtag->setIDPublication($publication->getId());

                    // Enregistrer l'objet Hashtag en persistance
                    $entityManager->persist($hashtag);

                }
                // Persistez l'entité Publication après avoir traité les images
                $entityManager->persist($publication);
                $entityManager->flush();


                return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);

            } else {

                return $this->redirectToRoute('app_login');
            }
        }

        // Rendre le formulaire et la vue
        return $this->render('publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_publication_show', methods: ['GET'])]
    public function show(Publication $publication): Response
    {
        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_publication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            $publication->setIDUtilisateur($user);

            if ($user) {

                if($form->get('images')->getData() != null){

                    // Assurez-vous d'avoir le bon emplacement pour la création des dossiers
                    $directory = "photo/";

                    $files = $form->get('images')->getData(); // On récupère le fichier
                    // $num_image doit contenir le nombre de photos déjà existantes dans le dossier correspondant a l'id de la publication
                    $num_image = count(glob($directory . $publication->getId() . '/*')) + 1;
                    foreach ($files as $file) {
                        $images = new Image();
                        $images->setIDPublication($publication);
                        $images->setNumImage($num_image);
                        $images->setPhoto("");

                        // Persistez l'entité Image avant de récupérer l'ID de la publication
                        $entityManager->persist($images);

                        // Flush pour s'assurer que l'entité Image est persisté et que l'ID de la publication est attribuée
                        $entityManager->flush();

                        // Obtenez l'ID de la publication après qu'elle a été persisté
                        $publicationId = $publication->getId();

                        // Créez un dossier pour chaque IDPublication s'il n'existe pas encore
                        $publicationDirectory = $directory . $publicationId;
                        if (!file_exists($publicationDirectory)) {
                            mkdir($publicationDirectory, 0777, true); // Créez le dossier avec les permissions nécessaires
                        }

                        // Générez le nom de fichier unique en utilisant le numéro de l'image
                        $filename = $num_image . '.' . $file->guessExtension();

                        // Déplacez le fichier dans le dossier correspondant à la publication
                        $file->move($publicationDirectory, $filename);

                        // Mettez à jour le nom de fichier de l'entité Image
                        $images->setPhoto($filename);

                        // Persistez à nouveau l'entité Image après avoir mis à jour le nom de fichier
                        $entityManager->persist($images);

                        // Incrémentez le numéro de l'image pour la prochaine itération
                        $num_image++;
                    }
                }

                if($form->get('videos')->getData() != null){

                    // Assurez-vous d'avoir le bon emplacement pour la création des dossiers
                    $directory = "videos/";

                    $files = $form->get('videos')->getData(); // On récupère le fichier
                    $num_lien = count(glob($directory . $publication->getId() . '/*')) + 1;
                    foreach ($files as $file) {
                        $videos = new Video();
                        $videos->setIDPublication($publication);
                        $videos->setNumLien($num_lien);
                        $videos->setLien("");
                        // Persistez l'entité Image avant de récupérer l'ID de la publication
                        $entityManager->persist($videos);

                        $entityManager->flush();

                        // Obtenez l'ID de la publication après qu'elle a été persisté
                        $publicationId = $publication->getId();

                        // Créez un dossier pour chaque IDPublication s'il n'existe pas encore
                        $publicationDirectory = $directory . $publicationId;
                        if (!file_exists($publicationDirectory)) {
                            mkdir($publicationDirectory, 0777, true); // Créez le dossier avec les permissions nécessaires
                        }

                        // Générez le nom de fichier unique en utilisant le numéro de l'image
                        $filename = $num_lien . '.' . $file->guessExtension();

                        // Déplacez le fichier dans le dossier correspondant à la publication
                        $file->move($publicationDirectory, $filename);

                        // Mettez à jour le nom de fichier de l'entité Image
                        $videos->setLien($filename);

                        // Persistez à nouveau l'entité Image après avoir mis à jour le nom de fichier
                        $entityManager->persist($videos);

                        // Incrémentez le numéro de l'image pour la prochaine itération
                        $num_lien++;
                    }
                }

                // Persistez l'entité Publication après avoir traité les images
                $entityManager->persist($publication);
                $entityManager->flush();


                return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);

            } else {
                // Si l'utilisateur n'est pas connecté, gérer le cas en conséquence (par exemple, rediriger vers la page de connexion)
                // Vous pouvez également enregistrer la publication sans associer un utilisateur, selon les besoins de votre application
                // Redirection vers la page de connexion par exemple :
                return $this->redirectToRoute('app_login');
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_publication_delete', methods: ['POST'])]
    public function delete(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
    }
}
