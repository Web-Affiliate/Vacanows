<?php

namespace App\Controller;

use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MailController extends AbstractController
{
    private $mailer;
    private $entityManager;

    public function __construct(Mailer $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    #[Route('/sendMail', name: 'sendMail')]
    public function sendMail(Request $request): Response
    {
        $data = $request->request->all();

        if(isset($data['name']) && isset($data['email']) && isset($data['subject']) && isset($data['message'])) {
            $name = $data['name'];
            $email = $data['email'];
            $subject = $data['subject'];
            $messageContent = $data['message'];

            $recepteur = 'vacanows@gmail.com';

            // Envoi de l'e-mail
            $this->mailer->sendContact($name, $email, ['subject' => $subject, 'message' => $messageContent], $recepteur, $subject);

            return $this->json(['message' => 'Votre message a été envoyé avec succès']);
        }

        return $this->json(['error' => 'Veuillez remplir tous les champs du formulaire'], 400);
    }
}
