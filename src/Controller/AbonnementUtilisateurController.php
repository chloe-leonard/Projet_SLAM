<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementUtilisateurController extends AbstractController
{
    #[Route('/abonnement/utilisateur', name: 'app_abonnement_utilisateur')]
    public function index(): Response
    {
        return $this->render('abonnement_utilisateur/index.html.twig', [
            'controller_name' => 'AbonnementUtilisateurController',
        ]);
    }

    #[Route('/abonnement/utilisateur/new', name: 'app_abonnement_utilisateur_new')]
    public function new(): Response
    {

        return $this->render('user/show.html.twig', [
            'controller_name' => 'AbonnementUtilisateurController',
        ]);
    }
}
