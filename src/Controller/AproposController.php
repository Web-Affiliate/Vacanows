<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Content;
use App\Entity\Guides;
use App\Entity\About;

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
    public function index(Request $request): Response
    {
        $cookieConsent = $request->cookies->get('cookieConsent');

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();
        $about = $this->entityManager->getRepository(About::class)->findOneBy([]);

        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }

        return $this->render('site/aboutUs/index.html.twig', [
            'content' => $content,
            'guides' => $guides,
            'meta_title' => $about->getMetaTitle(),
            'meta_description' => $about->getMetaDescription(),
            'titre_1' => $about->getTitre1(),
            'image_1' => $about->getImage1(),
            'paragraph_1' => $about->getParagraph1(),
            'image_2' => $about->getImage2(),
            'slogan_logo' => $about->getSloganLogo(),
            'image_panoramique' => $about->getImagePanoramique(),
            'paragraph_2' => $about->getParagraph2(),
            'image_3' => $about->getImage3(),
            'image_4' => $about->getImage4(),
            'text_final' => $about->getTextFinal(),
            'sites' => $about->getSites(),
            'showCookiePopup' => $data['showCookiePopup'],
        ]);
    }
}
