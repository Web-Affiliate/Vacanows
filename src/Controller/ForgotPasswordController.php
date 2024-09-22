<?php

// src/Controller/ForgotPasswordController.php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class ForgotPasswordController extends AbstractController
{
    private $userRepository;
    private $mailer;
    private $entityManager;

    public function __construct(UserRepository $userRepository, Mailer $mailer, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function request(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $user = $this->userRepository->findOneBy(['email' => $email]);

            if ($user) {
                // Générer un token si ce n'est pas déjà fait
                if (!$user->getToken()) {
                    $token = bin2hex(random_bytes(32)); // Génération d'un token aléatoire
                    $user->setToken($token);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                } else {
                    $token = $user->getToken(); // Récupérer le token existant
                }

                $this->mailer->sendPasswordResetEmail($user->getEmail(), $token);
                $this->addFlash('success', 'Un lien de réinitialisation a été envoyé à votre adresse e-mail.');
            } else {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cet e-mail.');
            }

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/forgot_password.html.twig');
    }


    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function reset(Request $request, string $token): Response
    {
        $user = $this->userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('Token invalide.');
        }

        $form = $this->createFormBuilder()
            ->add('password', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'attr' => ['placeholder' => 'Entrez votre nouveau mot de passe'],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); // Assure-toi que le mot de passe est haché
            $user->setToken('');
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/reset_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
