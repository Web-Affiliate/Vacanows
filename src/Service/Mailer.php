<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class Mailer{
    public $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }


    public function sendContact($emetteur, $email, array $data, $recepteur){
        $email = (new TemplatedEmail())
            ->from('vacanows@gmail.com')
            ->to($recepteur)
            ->subject('Nouveau message de '.$emetteur)
            ->htmlTemplate('site/mail/contact.html.twig')
            ->context([
                'data' => $data
            ]);

        $this->mailer->send($email);
    }
}