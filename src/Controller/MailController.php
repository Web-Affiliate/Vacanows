<?php

namespace App\Controller;

use App\Service\Mailer;
use App\Entity\Todo;
use App\Entity\Sites;
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

    /*    public function sendAlert($email, $data)
    {
        $alertEmail = (new TemplatedEmail())
        ->from('vacanows@gmail.com')
        ->to($email)
        ->subject('Inscription à la newsletter')
        ->htmlTemplate('site/mail/confirmationInscription.html.twig')
        ->context([
            'data' => $data
        ]);*/

    #[Route('/alertemail', name: 'alertemail')]
    public function sendAlertEmail(Request $request): Response
    {
        $email = $request->request->get('email');
        $site = $this->entityManager->getRepository(Sites::class)->findOneBy(['id' => 1]);
        $token = $this->generateToken(32);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json(['error' => 'Veuillez entrer une adresse e-mail valide.'], 400);
        }

        $todo = new Todo();
        $todo->setMail($email);
        $todo->setSite($site);
        $todo->setToken($token);

        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        $this->mailer->sendAlert($email, ['data' => $todo, 'token' => $token, 'site' => $site, 'email' => $email]);

        return $this->json(['message' => 'Inscription à la newsletter réussie.']);
    }

    public function generateToken($length)
    {
       return bin2hex(random_bytes($length));
    }

}
