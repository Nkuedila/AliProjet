<?php

namespace App\Controller;

use App\Entity\ContatEntity;
use App\Form\ContatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new  ContatEntity();
        $form = $this->createForm(ContatType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();


            $email = (new TemplatedEmail())
                ->from(new Address('hello@example.com', 'Your Company'))
                ->to(new Address('test@example.com', 'MailHog'))
                ->subject('New Contact Message')
                ->htmlTemplate('mailer/sendcontact.html.twig')
                ->context([
                    'message' => $message,
                ]);

            $mailer->send($email);


            // Optional: Add a flash message or redirect
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form
        ]);
    }
}
