<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Publication;
use App\Entity\User;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commentaire')]
class CommentaireController extends AbstractController
{
    #[Route('/', name: 'app_commentaire_index', methods: ['GET'])]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commentaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            if($user){
                $commentaire->setIDUtilisateur($user);
                //recupere l'id de la publication definit ic: path('app_commentaire_new', {'id': publication.id} ) sachant que publication est un objet
                $publication = $doctrine->getRepository(Publication::class)->find($request->get('id'));
                $commentaire->setIDPublication($publication);
                $commentaire->setCommentaire($form->get('commentaire')->getData());

                $entityManager->persist($commentaire);
                $entityManager->flush();

                return $this->redirectToRoute('app_publication_index');

            }
            else {
                $this->addFlash('error', 'Vous devez être connecté pour commenter');
                return $this->redirectToRoute('app_login');
            }


            return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_show', methods: ['GET'])]
    public function show(Commentaire $commentaire): Response
    {
        return $this->render('commentaire/show.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commentaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commentaire $commentaire, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);
        //on verifie si l'utilisateur connecté est celui qui a publié le commentaire ou si la publication correspondant au commentaire est la sienne
        if($this->getUser() == $commentaire->getIDUtilisateur() || $this->getUser() == $commentaire->getIDPublication()->getIDUtilisateur()){



            if ($form->isSubmitted() && $form->isValid()) {
                //on recupere le commentaire et on le modifie en gardant les id de l'utilisateur et de la publication
                $commentaire->setCommentaire($form->get('commentaire')->getData());


                $em->flush();

                return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('commentaire/edit.html.twig', [
                'commentaire' => $commentaire,
                'form' => $form,
            ]);
        }
        else {
            $this->addFlash('error', 'Vous ne pouvez pas modifier ce commentaire');
            return $this->redirectToRoute('app_publication_index');
        }


    }

    #[Route('/{id}', name: 'app_commentaire_delete', methods: ['POST'])]
    public function delete(Request $request, Commentaire $commentaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
