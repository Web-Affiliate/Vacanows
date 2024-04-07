<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use App\Entity\Articles;
use App\Entity\Guides;
use App\Entity\SousCategories2;

class GuidesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/guides/{guideSlug}', name: 'guides')]
    public function guides($guideSlug, Request $request): Response
    {
        $cookieConsent = $request->cookies->get('cookieConsent');
        $guide = $this->entityManager->getRepository(Guides::class)->findOneBy(['slug' => $guideSlug]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        if (!$guide) {
            throw $this->createNotFoundException('Guide non trouvé');
        }
        $article = $guide->getArticles();
        $articlesByGuide = $guide->getArticles();
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        $tempsLectureMin = PHP_INT_MAX;
        $tempsLectureMax = 0;
        foreach ($article as $a) {
            $tempsLecture = $a->getTempsLecture();
            if ($tempsLecture < $tempsLectureMin) {
                $tempsLectureMin = $tempsLecture;
            }
            if ($tempsLecture > $tempsLectureMax) {
                $tempsLectureMax = $tempsLecture;
            }
        }

        $souscategories2 = $this->entityManager->getRepository(SousCategories2::class)->findAll();

        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }

        return $this->render('site/guides/index.html.twig', [
            'guide' => $guide,
            'articlesByGuide' => $articlesByGuide,
            'content' => $content,
            'guides' => $guides,
            'article' => $article,
            'tempsLectureMin' => $tempsLectureMin,
            'tempsLectureMax' => $tempsLectureMax,
            'souscategories2' => $souscategories2,
            'showCookiePopup' => $data['showCookiePopup'],
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
        ]);
    }

}

?>
