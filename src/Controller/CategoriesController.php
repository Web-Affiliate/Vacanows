<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\SousCategories1;
use App\Entity\SousCategories2;
use App\Entity\Content;
use App\Entity\Articles;
use App\Entity\Guides;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/category/{categorySlug}', name: 'categorie_show')]
    public function showCategory($categorySlug): Response
    {
        $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);

        if (!$category) {
            throw $this->createNotFoundException('Pays non trouvé');
        }

        $sousCategories2Repository = $this->entityManager->getRepository(SousCategories2::class);
        $sousCategories = $category->getSousCategories1s();

        $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);

        $sousCategories1 = $sousCategories1Repository->findBy(['categories' => $category]);
        $articlesCountBySousCategorie1 = $sousCategories1Repository->countArticlesBySousCategorie1();

        $countSousCategories2 = [];
        foreach ($sousCategories1 as $sousCategory1) {
            $countSousCategories2[$sousCategory1->getId()] =
            $sousCategories2Repository->countSousCategories2BySousCategory($sousCategory1);
        }

        $sousCategories1 = $sousCategories1Repository->findBy(['categories' => $category]);

        $tempsLectureMin = PHP_INT_MAX;
        $tempsLectureMax = 0;
        foreach ($sousCategories1 as $sousCategory1) {
            foreach ($sousCategory1->getSousCategories2s() as $sousCategory2) {
                foreach ($sousCategory2->getArticles() as $article) {
                    $tempsLecture = $article->getTempsLecture();
                    if ($tempsLecture < $tempsLectureMin) {
                        $tempsLectureMin = $tempsLecture;
                    }
                    if ($tempsLecture > $tempsLectureMax) {
                        $tempsLectureMax = $tempsLecture;
                    }
                }
            }
        }

        if ($tempsLectureMin === PHP_INT_MAX || $tempsLectureMax === 0) {
            $tempsLecture = '0 min';
        } elseif ($tempsLectureMin === $tempsLectureMax) {
            $tempsLecture = $tempsLectureMin . ' min';
        } else {
            $tempsLecture = $tempsLectureMin . ' - ' . $tempsLectureMax . ' min';
        }

        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        return $this->render('site/categories/souscategories1/index.html.twig', [
            'content' => $content,
            'category' => $category,
            'sousCategories' => $sousCategories,
            'tempsLectureMin' => $tempsLectureMin,
            'tempsLectureMax' => $tempsLectureMax,
            'articlesCountBySousCategorie1' => $articlesCountBySousCategorie1,
            'countSousCategories2' => $countSousCategories2,
            'image_header' => $content->getImageHeader(),
            'image_header2' => $content->getImageHeader2(),
            'image_header3' => $content->getImageHeader3(),
            'image_header4' => $content->getImageHeader4(),
            'titre_header' => $content->getTitreHeader(),
            'paragraph_header' => $content->getParagraphHeader(),
            'placeholder_search' => $content->getPlaceholderSearch(),
            'tempsLecture' => $tempsLecture,
            'guides' => $guides
        ]);
    }


    #[Route('/category/{categorySlug}/SC1/{sousCategory1Slug}', name: 'sous_categorie1_show')]
    public function showSousCategorie($categorySlug, $sousCategory1Slug): Response
    {
        $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);
        $sousCategory1 = $sousCategories1Repository->findOneBy(['slug' => $sousCategory1Slug]);

        $sousCategories2 = $sousCategory1->getSousCategories2s();
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $articlesCountBySousCategory2 = [];
        foreach ($sousCategories2 as $sousCategory2) {
            $articlesCountBySousCategory2[$sousCategory2->getId()] = $sousCategory2->getArticles()->count();
        }

        $tempsLectureMin = PHP_INT_MAX;
        $tempsLectureMax = 0;

        foreach ($sousCategories2 as $sousCategory2) {
            foreach ($sousCategory2->getArticles() as $article) {
                $tempsLecture = $article->getTempsLecture();

                if ($tempsLecture < $tempsLectureMin) {
                    $tempsLectureMin = $tempsLecture;
                }
                if ($tempsLecture > $tempsLectureMax) {
                    $tempsLectureMax = $tempsLecture;
                }
            }
        }

        if ($tempsLectureMin === PHP_INT_MAX || $tempsLectureMax === 0) {
            $tempsLecture = '0 min';
        } elseif ($tempsLectureMin === $tempsLectureMax) {
            $tempsLecture = $tempsLectureMin . ' min';
        } else {
            $tempsLecture = $tempsLectureMin . ' - ' . $tempsLectureMax . ' min';
        }

        $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        return $this->render('site/categories/souscategories2/index.html.twig', [
            'sousCategory1' => $sousCategory1,
            'sousCategories2' => $sousCategories2,
            'articlesCountBySousCategory2' => $articlesCountBySousCategory2,
            'categorySlug' => $categorySlug,
            'sousCategory1Slug' => $sousCategory1Slug,
            'content' => $content,
            'categories' => $category,
            'image_header' => $content->getImageHeader(),
            'image_header2' => $content->getImageHeader2(),
            'image_header3' => $content->getImageHeader3(),
            'image_header4' => $content->getImageHeader4(),
            'titre_header' => $content->getTitreHeader(),
            'paragraph_header' => $content->getParagraphHeader(),
            'placeholder_search' => $content->getPlaceholderSearch(),
            'tempsLecture' => $tempsLecture,
            'guides' => $guides
        ]);
    }

    #[Route('/category/{categorySlug}/SC1/{sousCategory1Slug}/SC2/{sousCategory2Slug}', name: 'sous_categorie2_show')]
    public function showSousCategorie2($categorySlug, $sousCategory1Slug, $sousCategory2Slug): Response
    {
        $sousCategory2 = $this->entityManager->getRepository(SousCategories2::class)->findOneBy(['slug' => $sousCategory2Slug]);

        if (!$sousCategory2) {
            throw $this->createNotFoundException('Ville non trouvée');
        }

        $articles = $sousCategory2->getArticles();
        $tempsLectureMin = PHP_INT_MAX;
        $tempsLectureMax = 0;
        foreach ($articles as $article) {
            $tempsLecture = $article->getTempsLecture();
            if ($tempsLecture < $tempsLectureMin) {
                $tempsLectureMin = $tempsLecture;
            }
            if ($tempsLecture > $tempsLectureMax) {
                $tempsLectureMax = $tempsLecture;
            }
        }

        // Gestion d'erreur si aucun article trouvé
        if ($tempsLectureMin === PHP_INT_MAX || $tempsLectureMax === 0) {
            $tempsLecture = '0 min';
        } elseif ($tempsLectureMin === $tempsLectureMax) {
            $tempsLecture = $tempsLectureMin . ' min';
        } else {
            $tempsLecture = $tempsLectureMin . ' - ' . $tempsLectureMax . ' min';
        }

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $sousCategory1 = $sousCategory2->getSousCategorie1();
        $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);
        $guides = $this->entityManager->getRepository(Guides::class)->findAll();
        $sousCategories2Names = $this->entityManager->getRepository(SousCategories2::class)->findAll();
        return $this->render('site/categories/articles/index.html.twig', [
            'categorySlug' => $categorySlug,
            'sousCategory1Slug' => $sousCategory1Slug,
            'sousCategory2Slug' => $sousCategory2Slug,
            'content' => $content,
            'articles' => $articles,
            'sousCategory2' => $sousCategory2,
            'categories' => $category,
            'sous_categories_1' => $sousCategory1,
            'image_header' => $content->getImageHeader(),
            'image_header2' => $content->getImageHeader2(),
            'image_header3' => $content->getImageHeader3(),
            'image_header4' => $content->getImageHeader4(),
            'titre_header' => $content->getTitreHeader(),
            'paragraph_header' => $content->getParagraphHeader(),
            'placeholder_search' => $content->getPlaceholderSearch(),
            'sousCategories2Names' => $sousCategories2Names,
            'tempsLecture' => $tempsLecture,
            'guides' => $guides
        ]);
    }


    #[Route('/category', name: 'categoriesglob_show')]
public function showCategories(): Response
{
    $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
    $categories = $this->entityManager->getRepository(Categories::class)->findAll();
    $countCategory = $this->entityManager->getRepository(Categories::class)->countCountries();
    $articlePerCategory = $this->entityManager->getRepository(Categories::class)->countArticlesByCategories();
    $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);
    $sousCategoriesByCategory = [];

    foreach ($categories as $category) {
        $sousCategories = $sousCategories1Repository->findBy(['categories' => $category]);
        $sousCategoriesByCategory[$category->getId()] = $sousCategories;
    }
    $guides = $this->entityManager->getRepository(Guides::class)->findAll();

    return $this->render('site/categories/categories.html.twig', [
        'content' => $content,
        'countCategory' => $countCategory,
        'categories' => $categories,
        'articlePerCategory' => $articlePerCategory,
        'sousCategoriesByCategory' => $sousCategoriesByCategory,
        'image_header' => $content->getImageHeader(),
        'image_header2' => $content->getImageHeader2(),
        'image_header3' => $content->getImageHeader3(),
        'image_header4' => $content->getImageHeader4(),
        'titre_header' => $content->getTitreHeader(),
        'paragraph_header' => $content->getParagraphHeader(),
        'placeholder_search' => $content->getPlaceholderSearch(),
        'guides' => $guides
    ]);
}

#[Route('/SC1', name: 'sous_categories1glob_show')]
public function showSousCategories(): Response
{
    $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

    $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);
    $sousCategories1 = $sousCategories1Repository->findAll();

    $articlesCountBySousCategorie1 = [];
    $category = [];
    $sousCategories2Repository = $this->entityManager->getRepository(SousCategories2::class);

    foreach ($sousCategories1 as $sousCategory1) {
        $articlesCountBySousCategorie1 = $sousCategories1Repository->countArticlesSousCategorieAll();
        $countSousCategories2[$sousCategory1->getId()] =$sousCategories2Repository->countSousCategories2BySousCategory($sousCategory1);

        $category[$sousCategory1->getId()] = $sousCategory1->getCategories();
    }

    $guides = $this->entityManager->getRepository(Guides::class)->findAll();

    return $this->render('site/categories/souscategories1.html.twig', [
        'content' => $content,
        'sousCategories' => $sousCategories1,
        'articlesCountBySousCategorie1' => $articlesCountBySousCategorie1,
        'category' => $category,
        'image_header' => $content->getImageHeader(),
        'image_header2' => $content->getImageHeader2(),
        'image_header3' => $content->getImageHeader3(),
        'image_header4' => $content->getImageHeader4(),
        'titre_header' => $content->getTitreHeader(),
        'paragraph_header' => $content->getParagraphHeader(),
        'placeholder_search' => $content->getPlaceholderSearch(),
        'guides' => $guides,
        'countSousCategories2' => $countSousCategories2
    ]);
}

#[Route('/SC2', name: 'sous_categories2glob_show')]
public function showSousCategories1(): Response
{
    $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

    $sousCategories2Repository = $this->entityManager->getRepository(SousCategories2::class);
    $sousCategories2 = $sousCategories2Repository->findAll();

    $articlesCountByVille = [];
    foreach ($sousCategories2 as $sousCategory2) {
        $articlesCountByVille[$sousCategory2->getId()] = $sousCategory2->getArticles()->count();
    }

    $category = $this->entityManager->getRepository(Categories::class)->findOneBy([]);
    $sousCategory1 = $this->entityManager->getRepository(SousCategories1::class)->findOneBy([]);
    $souscategoryAll = $this->entityManager->getRepository(SousCategories1::class)->findAll();
    $guides = $this->entityManager->getRepository(Guides::class)->findAll();

    return $this->render('site/categories/souscategories2.html.twig', [
        'content' => $content,
        'sousCategories2' => $sousCategories2,
        'articlesCountByVille' => $articlesCountByVille,
        'category' => $category,
        'sousCategory' => $sousCategory1,
        'souscategoryAll' => $souscategoryAll,
        'image_header' => $content->getImageHeader(),
        'image_header2' => $content->getImageHeader2(),
        'image_header3' => $content->getImageHeader3(),
        'image_header4' => $content->getImageHeader4(),
        'titre_header' => $content->getTitreHeader(),
        'paragraph_header' => $content->getParagraphHeader(),
        'placeholder_search' => $content->getPlaceholderSearch(),
        'guides' => $guides
    ]);
}

#[Route('/articles', name: 'articles')]
public function articles(Request $request): Response
{
    $sousCategorie2Ids = array_filter($request->query->all(), function ($key) {
        return $key === 'sousCategorie2Id';
    }, ARRAY_FILTER_USE_KEY);

    if (!empty($sousCategorie2Ids)) {
        $articles = [];
        foreach ($sousCategorie2Ids as $sousCategorie2Id) {
            $articles = array_merge($articles, $this->entityManager->
            getRepository(Articles::class)->findBy(['sous_categories_2' => $sousCategorie2Id]));
        }
    } else {
        $articles = $this->entityManager->getRepository(Articles::class)->findAll();
    }

    $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
    $guides = $this->entityManager->getRepository(Guides::class)->findAll();

    $sousCategories2Repository = $this->entityManager->getRepository(SousCategories2::class);
    $sousCategories2Names = $sousCategories2Repository->findAll();
    $displayedCategories = [];
    return $this->render('site/reponse_select/articles.html.twig', [
        'articles' => $articles,
        'content' => $content,
        'guides' => $guides,
        'sousCategories2Names' => $sousCategories2Names,
        'displayedCategories' => $displayedCategories
    ]);
}
}
