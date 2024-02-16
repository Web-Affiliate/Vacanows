<?php

// src/Controller/ArticleController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\Content;

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

        return $this->render('site/article/index.html.twig', [
            'article' => $article,
            'content' => $content,
            'navbar' => $navbar,
            'slug' => $article->getSlug(),
            'titre_1' => $article->getTitre1(),
            'sites' => $article->getSites(),
            'sous_categories_2' => $article->getSousCategories2(),
            'created_date' => $article->getCreatedDate(),
            'temps_lecture' => $article->getTempsLecture(),
            'paragraph_1' => $article->getParagraph1(),
            'image_1' => $article->getImage1(),
            'titre_2' => $article->getTitre2(),
            'paragraph_2' => $article->getParagraph2(),
            'titre_3' => $article->getTitre3(),
            'paragraph_3' => $article->getParagraph3(),
            'titre_4' => $article->getTitre4(),
            'paragraph_4' => $article->getParagraph4(),
            'tab_item_1' => $article->getTabItem1(),
            'tab_item_2' => $article->getTabItem2(),
            'tab_item_3' => $article->getTabItem3(),
            'tab_item_4' => $article->getTabItem4(),
            'tab_item_5' => $article->getTabItem5(),
            'tab_item_6' => $article->getTabItem6(),
            'tab_item_7' => $article->getTabItem7(),
            'tab_item_8' => $article->getTabItem8(),
            'libelle_bouton_tab' => $article->getLibelleBoutonTab(),
            'tab_col_url_1' => $article->getTabColUrl1(),
            'tab_col_url_2' => $article->getTabColUrl2(),
            'tab_col_url_3' => $article->getTabColUrl3(),
            'guides' => $article->getGuides(),
            'meta' => $article->getMeta(),
        ]);
    }
}
