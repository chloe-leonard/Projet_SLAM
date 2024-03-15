<?php

namespace App\Controller;
use App\Form\ReinitialisationMotDePasseType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         //if ($this->getUser()) {
         //    return $this->redirectToRoute('target_path');
         //}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
/*
    #[Route('/oubli-pass', name:'MotDePasseOublie')]
    public function MotDePasseOublie(Request $request, UserRepository $userRepository, TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager, SendMailService $mail):Response
    {
        $form = $this->createForm(ReinitialisationMotDePasseType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $user = $userRepository->findOneByEmail($form->get('email')->getData());
            $token= $tokenGenerator->generateToken();

            $user->setResetToken($token);
            $entityManager->persist($user);
            $entityManager->flush();


            $url = $this->generateUrl('reset_MotDePasse', ['token' => $token],UrlGeneratorInterface::ABSOLUTE_URL);
            $context = compact('url', 'user');
            $mail->send('no-reply@tardyGrade.fr', $user->getMail(), 'Réinitialisation de votre mot de passe', 'security/email/ReinitialisationMotDePasse.html.twig', $context);

        }

        return $this->render('security/MotDePasseOublie.html.twig');

    }
*/
}
