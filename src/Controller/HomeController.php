<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->isGranted("ROLE_PATIENT")) {
            return $this->redirectToRoute('app_patient');
        } elseif ($this->isGranted("ROLE_SPECIALIST")) {
            return $this->redirectToRoute('app_specialist');
        }
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
