<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Sites;
use App\Entity\Content;
use App\Entity\Guides;


class MentionLegaleController extends AbstractController
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mention", name="mention_legale")
     */
    #[Route('/mention', name: 'mention_legale')]
    public function mentionLegale(Request $request): Response
    {
        $cookieConsent = $request->cookies->get('cookieConsent');

        $sites = $this->entityManager->getRepository(Sites::class)->find(1);
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }

        return $this->render('site/mentionLegale/index.html.twig', [
            'sites' => $sites,
            'content' => $content,
            'guides' => $guides,
            'showCookiePopup' => $data['showCookiePopup'],
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
        ]);

    }
}
