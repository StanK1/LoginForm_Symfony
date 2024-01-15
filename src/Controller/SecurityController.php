<?php

// src/Controller/SecurityController.php
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
        // Check if the user is already logged in
        if ($this->getUser()) {

            return $this->redirectToRoute('app_welcome');
        }

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/welcome.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
        ]);
    }

    #[Route('/welcome', name: 'app_welcome')]
    public function welcome(): Response
    {
        // Get the username of the logged-in user
        $user = $this->getUser();

        $username = $user ? $user->getUserIdentifier() : 'Guest';

        return $this->render('security/welcome.html.twig', ['username' => $username]);
    }

}
