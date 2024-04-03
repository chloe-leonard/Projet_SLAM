<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class APIController extends AbstractController
{

    #[Route('/getNbPublications', name: 'app_a_p_i')]
    //recupere 2 dates en parametre et renvoie le nombre de publications créées entre ces 2 dates
    public function getNbPublications(ManagerRegistry $doctrine): Response
    {
        return $this->json(12);

        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];

        $publications = $doctrine->getRepository(Publication::class)->findAll();
        $nbPublications = 0;
        foreach ($publications as $publication) {
            if ($publication->getDatePublication() >= $date1 && $publication->getDatePublication() <= $date2) {
                $nbPublications++;
            }
        }
        return $this->json($nbPublications);
    }

    public function index( ManagerRegistry $doctrine): Response
    {
        //renvoie le nombre de comptes utilisateurs créés
        $repository = $doctrine->getRepository(User::class);
        $users = $repository->findAll();
        $nbUsers = count($users);

        //renvoie le nombre de publications créées
        $publications = $doctrine->getRepository(Publication::class)->findAll();
        $nbPublications = $this->getNbPublications($doctrine);

        return $this->json([
            'Comptes' => [
                'ComptePostantLePlus' => 'nbComptes',
                'nbUsers' => $nbUsers
            ],
            'Posts' => [
                'nbPosts' => $nbPublications
            ]
        ]);
        //affichage du resultat en json:
        // {
        //     "Comptes": {
        //         "ComptePostantLePlus": "nbComptes",
        //         "nbUsers": 1
        //     },
        //     "Posts": {
        //         "nbPosts": 1
        //     }
        // }


    }

}
