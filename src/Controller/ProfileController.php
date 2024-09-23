<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProfileFormType;
use App\Entity\Content;
use App\Entity\Comment;
use App\Entity\Guides;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    private $entityManager;
    private $passwordHasher;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/profile", name="profile_index")
     */
    #[Route('/profile', name: 'profile_index')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if (!empty($plainPassword)) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès.');
            return $this->redirectToRoute('profile_index');
        }


        $cookieConsent = $request->cookies->get('cookieConsent');
        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }
        // Récupérer l'historique des commentaires
        $comments = $this->entityManager->getRepository(Comment::class)->findBy(['user' => $user], ['date_creation' => 'DESC']);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        return $this->render('site/profile/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'content' => $content,
            'comments' => $comments,
            'guides' => $guides,
            'showCookiePopup' => $data['showCookiePopup'],
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
        ]);
    }

    /**
     * @Route("/profile/delete", name="profile_delete", methods={"GET"})
     */
#[Route('/profile/delete', name: 'profile_delete', methods: ['GET'])]
public function delete(Request $request): Response
{
   // Récupérer l'utilisateur actuel
   $user = $this->getUser();

   if (!$user) {
       return $this->redirectToRoute('app_login');
   }

   // Invalider le jeton de l'utilisateur et déconnecter
   $this->tokenStorage->setToken(null);
   $request->getSession()->invalidate();

   // Supprimer l'utilisateur de la base de données
   $this->entityManager->remove($user);
   $this->entityManager->flush();

   // Afficher un message de confirmation
   $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

   // Rediriger vers la page de déconnexion ou d'accueil
   return $this->redirectToRoute('home'); // Changez pour la route souhaitée
}
}
