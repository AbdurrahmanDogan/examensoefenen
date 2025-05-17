<?php

namespace App\Controller;

use App\Form\AppointmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class AppointmentController extends AbstractController
{
    #[Route('/create-appointment', name: 'app_create_appointment')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(AppointmentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $appointment = $form->getData();
            $entityManager->persist($appointment);
            $entityManager->flush();

            $this->addFlash('success', 'Appointment is toegevoegd');

            return $this->redirectToRoute('app_specialist');
        }
        return $this->render('appointment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
