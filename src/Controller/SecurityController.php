<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already logged in
        if ($this->getUser()) {
            return $this->redirectToRoute('app_welcome');
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/registration.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            // Include any other data necessary for the registration form
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ["GET"])]
    public function logout(): void
    {
        // None
    }

    #[Route('/welcome', name: 'app_welcome')]
    public function welcome(): Response
    {
        $user = $this->getUser();
        $username = $user ? $user->getUserIdentifier() : 'Sirius';

        return $this->render('welcome.html.twig', [
            'username' => $username,
        ]);
    }
}
