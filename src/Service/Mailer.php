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
            ->from('no-reply@vacanows.com')
            ->to($email)
            ->subject('Confirmation de réception de votre message')
            ->htmlTemplate('site/mail/contact.html.twig')
            ->context([
                'data' => $data
            ]);

        $vacanowsEmail = (new TemplatedEmail())
            ->from('no-reply@vacanows.com')
            ->to($recepteur)
            ->subject($subject . ' - ' . $email . ' - ' . $emetteur)
            ->text($data['message']);


        $this->mailer->send($userEmail);
        $this->mailer->send($vacanowsEmail);
    }

    public function sendAlert($email, $data)
    {
        $alertEmail = (new TemplatedEmail())
            ->from('no-reply@vacanows.com')
            ->to($email)
            ->subject('Inscription à la newsletter')
            ->htmlTemplate('site/mail/confirmationInscription.html.twig')
            ->context([
                'data' => $data
            ]);

        $this->mailer->send($alertEmail);
    }

    public function sendCurrentAlert($email, $data)
    {
        $alertEmail = (new TemplatedEmail())
            ->from('no-reply@vacanows.com')
            ->to($email)
            ->subject('Articles récents de notre plateforme')
            ->htmlTemplate('site/mail/articlesAlert.html.twig')
            ->context([
                'data' => $data
            ]);

        $this->mailer->send($alertEmail);
    }

    public function sendPasswordResetEmail($email, $token)
    {
        $resetEmail = (new TemplatedEmail())
            ->from('no-reply@vacanows.com')
            ->to($email)
            ->subject('Réinitialisation de votre mot de passe')
            ->htmlTemplate('site/mail/reset_password.html.twig')
            ->context([
                'resetToken' => $token,
                'userEmail' => $email,
            ]);

        $this->mailer->send($resetEmail);
    }


}
