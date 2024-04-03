<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\SignalementPublication;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/signalementPublication')]
class SignalementPublicationController extends AbstractController
{


    #[Route('/{id}', name: 'app_signalementpublication_new', methods: ['GET', 'POST'])]
    public function new($id, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $signalementPublication = new SignalementPublication();

        $repository = $doctrine->getRepository(Publication::class);

        $repositoryUser = $doctrine->getRepository(User::class);
        $user = $repositoryUser->find($id);

        //voir la liste des idpublication signalées par l'utilisateur :
        $listePublication =  $user->getSignalementPublications();

        $alreadyReported = false;
        foreach ($listePublication as $signalement) {
            if ($signalement->getIdPublication()->getId() == $id) {
                $alreadyReported = true;
                break;
            }
        }

        if ($alreadyReported) {
            return $this->render('publication/index.html.twig', [
            'message' => 'Vous avez déjà signalé cette publication',
            'publications' => $repository->findAll(),
            ]);
        } else {
            //recupere la publication correspondant à l'id passé en parametre
            $publicationsignale = $repository->find($id);

            $signalementPublication->setIdPublication($publicationsignale);
            $signalementPublication->setIDSignaleur($user);
            $entityManager->persist($signalementPublication);
            $entityManager->flush();

            return $this->render('publication/index.html.twig', [
                'message' => 'Merci d avoir signalé cette publication',
                'publications' => $repository->findAll(),
            ]);
        }
    }


}
