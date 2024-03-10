<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use App\Entity\Guides;

class AproposController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/about-us", name="about-us")
     */
    #[Route('/about-us', name: 'about-us')]
    public function index(): Response
    {
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        return $this->render('site/aboutUs/index.html.twig', [
            'content' => $content,
            'guides' => $guides
        ]);
    }
}
