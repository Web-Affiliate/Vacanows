<?php

// src/Controller/ArticleController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\SousCategories2;
use App\Entity\Content;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/article/{slug}", name="article_show")
     */
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(Articles $article): Response
    {
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $navbar = [];
        for($i=1; $i<=5; $i++){
            $navbar[] = $content->{"getNavbar$i"}();
        }

        $lastArticles = $this->entityManager->getRepository(Articles::class)->findBy([], ['id' => 'DESC'], 4);
        $totalArticles = $this->entityManager->getRepository(Articles::class)->countTotalArticles();
        $offset = count($lastArticles);

        $hasMoreArticles = count($lastArticles) === 4;
        $limit = 3;

        return $this->render('site/article/index.html.twig', [
            'article' => $article,
            'total' => $totalArticles,
            'content' => $content,
            'navbar' => $navbar,
            'lastArticles' => $lastArticles,
            'slug' => $article->getSlug(),
            'titre_1' => $article->getTitre1(),
            'sites' => $article->getSites(),
            'sous_categories_2' => $article->getSousCategories2(),
            'created_date' => $article->getCreatedDate(),
            'temps_lecture' => $article->getTempsLecture(),
            'paragraph_1' => $article->getParagraph1(),
            'image' => $article->getImage1(),
            'titre_2' => $article->getTitre2(),
            'paragraph_2' => $article->getParagraph2(),
            'titre_3' => $article->getTitre3(),
            'paragraph_3' => $article->getParagraph3(),
            'titre_4' => $article->getTitre4(),
            'paragraph_4' => $article->getParagraph4(),
            'tab_libelle_1' => $article->isTabLibelle1(),
            'tab_libelle_2' => $article->isTabLibelle2(),
            'tab_libelle_3' => $article->isTabLibelle3(),
            'tab_libelle_4' => $article->isTabLibelle4(),
            'tab_libelle_5' => $article->isTabLibelle5(),
            'tab_libelle_6' => $article->isTabLibelle6(),
            'tab_libelle_7' => $article->isTabLibelle7(),
            'tab_libelle_8' => $article->isTabLibelle8(),
            'tab_libelle_9' => $article->isTabLibelle9(),
            'tab_libelle_10' => $article->isTabLibelle10(),
            'tab_libelle_11' => $article->isTabLibelle11(),
            'tab_libelle_12' => $article->isTabLibelle12(),
            'libelle_bouton_tab' => $article->getLibelleBoutonTab(),
            'tab_col_url_1' => $article->getTabColUrl1(),
            'tab_col_url_2' => $article->getTabColUrl2(),
            'tab_col_url_3' => $article->getTabColUrl3(),
            'guides' => $article->getGuides(),
            'meta' => $article->getMeta(),
            'offset' => $offset,
            'hasMoreArticles' => $hasMoreArticles,
            'limit' => $limit,

        ]);
    }

    /**
     * @Route("/load-more-articles{offset}", name="load_more_articles", methods={"GET"})
     */
    #[Route('/load-more-articles{offset}', name: 'load_more_articles', methods: ['GET'])]
     public function loadMoreArticles(Request $request)
     {
        $offset = $request->query->get('offset', 0);
        $references = $this->entityManager->getRepository(Articles::class)->findNextArticles($offset, 3);


        return $this->render('site/article/loadMore.html.twig', [
            'articles' => $references,
        ]);
    }

}
