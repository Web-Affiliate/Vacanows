<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use App\Entity\Articles;
use App\Entity\Guides;

class GuidesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/guides/{guideSlug}', name: 'guides')]
    public function guides($guideSlug): Response
    {
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

        return $this->render('site/guides/index.html.twig', [
            'guide' => $guide,
            'articlesByGuide' => $articlesByGuide,
            'content' => $content,
            'guides' => $guides,
            'article' => $article,
            'tempsLectureMin' => $tempsLectureMin,
            'tempsLectureMax' => $tempsLectureMax
        ]);
    }

}

?>
