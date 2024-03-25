<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class Mailer
{
    public $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendContact($emetteur, $email, array $data, $recepteur, $subject)
    {
        $userEmail = (new TemplatedEmail())
            ->from('vacanows@gmail.com')
            ->to($email)
            ->subject('Confirmation de réception de votre message')
            ->htmlTemplate('site/mail/contact.html.twig')
            ->context([
                'data' => $data
            ]);

        $vacanowsEmail = (new TemplatedEmail())
            ->from($email)
            ->to($recepteur)
            ->subject($subject . ' - ' . $email . ' - ' . $emetteur)
            ->text($data['message']);


        $this->mailer->send($userEmail);
        $this->mailer->send($vacanowsEmail);
    }

    public function sendAlert($email, $data)
    {
        dump($data);

        $alertEmail = (new TemplatedEmail())
        ->from('vacanows@gmail.com')
        ->to($email)
        ->subject('Inscription à la newsletter')
        ->htmlTemplate('site/mail/confirmationInscription.html.twig')
        ->context([
            'data' => $data
        ]);

        $this->mailer->send($alertEmail);
    }

}
