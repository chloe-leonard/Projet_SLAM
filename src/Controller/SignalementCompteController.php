<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\SignalementCompte;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignalementCompteController extends AbstractController
{
    #[Route('/signalement/compte', name: 'app_signalement_compte')]
    public function index(): Response
    {
        return $this->render('signalement_compte/index.html.twig', [
            'controller_name' => 'SignalementCompteController',
        ]);
    }


    #[Route('/{id}', name: 'app_signalementcompte_new', methods: ['GET', 'POST'])]
    public function new($id, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $signalementCompte = new SignalementCompte();

        $repository = $doctrine->getRepository(Publication::class);

        $repositoryUser = $doctrine->getRepository(User::class);
        $user = $repositoryUser->find($id);

        //voir la liste des idUser signalées par l'utilisateur :
        $listeSignalement = $user->getSignalementComptes();

        $alreadyReported = false;
        foreach ($listeSignalement as $signalement) {
            if ($signalement->getIdUser()->getId() == $id) {
                $alreadyReported = true;
                break;
            }
        }

        if ($alreadyReported) {
            return $this->render('publication/index.html.twig', [
                'message' => 'Vous avez déjà signalé cet utilisateur',
                'publications' => $repository->findAll(),
            ]);
        } else {
            //recupere la publication correspondant à l'id passé en parametre
            $publicationsignale = $repository->find($id);

            //recupere l'utilisateur connecté
            $connecteduser = $this->getUser();
            $signalementCompte->setIDUserSignale($user);
            $signalementCompte->setIDSignaleur($connecteduser);
            $entityManager->persist($signalementCompte);
            $entityManager->flush();

            //on incremente le nombre de signalement de l'utilisateur signalé
            $user->setNbSignalement($user->getNbSignalement()+1);
            $entityManager->persist($user);
            $entityManager->flush();


            return $this->render('publication/index.html.twig', [
                'message' => 'Merci d avoir signalé cet utilisateur',
                'publications' => $repository->findAll(),
            ]);
        }
    }




}
