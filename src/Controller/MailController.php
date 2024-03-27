<?php

namespace App\Controller;

use App\Service\Mailer;
use App\Entity\Todo;
use App\Entity\Sites;
use App\Entity\Content;
use App\Entity\Guides;
use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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

            $this->mailer->sendAlert($email, [
                'token' => $token,
                'site' => $site,
                'email' => $email
            ]);

            return $this->json(['message' => 'Inscription à la newsletter réussie.']);
        }

        #[Route('/your-alert-mail/{token}', name: 'your_alert_mail')]
        public function yourAlertMail(Request $request, $token): Response
        {
            $todoRepository = $this->entityManager->getRepository(Todo::class);
            $todo = $todoRepository->findOneBy(['token' => $token]);
            $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
            $guides = $this->entityManager->getRepository(Guides::class)->findAll();

            if (!$todo) {
                throw new NotFoundHttpException();
            }

            return $this->render('site/mail/desinscriptionAlertMail.html.twig', [
                'token' => $token,
                'content' => $content,
                'guides' => $guides
            ]);
        }

        #[Route('/unsubscribe', name: 'unsubscribe', methods: ['POST'])]
        public function unsubscribe(Request $request, EntityManagerInterface $entityManager): JsonResponse
        {
            $data = json_decode($request->getContent(), true);

            if (isset($data['email'])) {
                $todoRepository = $entityManager->getRepository(Todo::class);
                $todo = $todoRepository->findOneBy(['mail' => $data['email']]);

                if ($todo && $todo->getToken() === $data['token']) {
                    $entityManager->remove($todo);
                    $entityManager->flush();

                    return new JsonResponse(['success' => true]);
                } else {
                    return new JsonResponse(['success' => false, 'error' => 'Invalid email or token.'], 400);
                }
            }

            return new JsonResponse(['success' => false, 'error' => 'Email and token are required.'], 400);
        }


    public function generateToken($length)
    {
       return bin2hex(random_bytes($length));
    }

}
