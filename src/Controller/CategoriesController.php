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
use Doctrine\ORM\EntityManagerInterface;

class CategoriesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/pays/{categorySlug}', name: 'categorie_show')]
    public function showCategory($categorySlug): Response
    {
        $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);

        if (!$category) {
            throw $this->createNotFoundException('Pays non trouvé');
        }

        $sousCategories1Repository = $this->entityManager->getRepository
        (SousCategories1::class);

        $tempsLectureMin = $this->entityManager->getRepository(Articles::class)->findTempsLectureMin();
        $tempsLectureMax = $this->entityManager->getRepository(Articles::class)->findTempsLectureMax();
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

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        return $this->render('site/categories/souscategories1/index.html.twig', [
            'content' => $content,
            'category' => $category,
            'sousCategories' => $sousCategories,
            'tempsLectureMin' => $tempsLectureMin,
            'tempsLectureMax' => $tempsLectureMax,
            'articlesCountBySousCategorie1' => $articlesCountBySousCategorie1,
            'countSousCategories2' => $countSousCategories2
        ]);
    }

    #[Route('/pays/{categorySlug}/region/{sousCategory1Slug}', name: 'sous_categorie1_show')]
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

        $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);


            // $tempsLectureMinBySousCategorie1 = $this->entityManager->
    // getRepository(Articles::class)->findTempsLectureMinBySousCategorie1();
    // $tempsLectureMaxBySousCategorie1 = $this->entityManager->
    // getRepository(Articles::class)->findTempsLectureMaxBySousCategorie1();

        return $this->render('site/categories/souscategories2/index.html.twig', [
            'sousCategory1' => $sousCategory1,
            'sousCategories2' => $sousCategories2,
            'articlesCountBySousCategory2' => $articlesCountBySousCategory2,
            'categorySlug' => $categorySlug,
            'sousCategory1Slug' => $sousCategory1Slug,
            'content' => $content,
            'categories' => $category,
        ]);
    }

    #[Route('/pays/{categorySlug}/region/{sousCategory1Slug}/ville/{sousCategory2Slug}', name: 'sous_categorie2_show')]
    public function showSousCategorie2($categorySlug, $sousCategory1Slug, $sousCategory2Slug): Response
    {

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        $sousCategory2 = $this->entityManager->getRepository(
            SousCategories2::class)->findOneBy(['slug' => $sousCategory2Slug]);

            $sousCategory1 = $sousCategory2->getSousCategorie1();
            $articles = $sousCategory2->getArticles();

            $category = $this->entityManager->getRepository(Categories::class)->findOneBy(['slug' => $categorySlug]);


        return $this->render('site/categories/articles/index.html.twig', [
            'categorySlug' => $categorySlug,
            'sousCategory1Slug' => $sousCategory1Slug,
            'sousCategory2Slug' => $sousCategory2Slug,
            'content' => $content,
            'articles' => $articles,
            'sousCategory2' => $sousCategory2,
            'categories' => $category,
            'sous_categories_1' => $sousCategory1,

            // 'tempsLecture' => $tempsLecture
        ]);
    }

    #[Route('/pays', name: 'categoriesglob_show')]
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

    $tempsLectureMin = $this->entityManager->getRepository(Articles::class)->findTempsLectureMin();
    $tempsLectureMax = $this->entityManager->getRepository(Articles::class)->findTempsLectureMax();

    return $this->render('site/categories/categories.html.twig', [
        'content' => $content,
        'countCategory' => $countCategory,
        'categories' => $categories,
        'articlePerCategory' => $articlePerCategory,
        'sousCategoriesByCategory' => $sousCategoriesByCategory,
        'tempsLectureMin' => $tempsLectureMin,
        'tempsLectureMax' => $tempsLectureMax
    ]);
}

#[Route('/region', name: 'sous_categories1glob_show')]
public function showSousCategories(): Response
{
    $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

    $category = $this->entityManager->getRepository(Categories::class)->findOneBy([]);

    $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);
    $sousCategories1 = $sousCategories1Repository->findAll();
    $sousCategories2Repository = $this->entityManager->getRepository(SousCategories2::class);
    $articlesCountBySousCategorie1 = $sousCategories1Repository->countArticlesSousCategorieAll();

    $countSousCategories2 = [];
    foreach ($sousCategories1 as $sousCategory1) {
        $countSousCategories2[$sousCategory1->getId()] =
        $sousCategories2Repository->countSousCategories2BySousCategory($sousCategory1);
    }

    return $this->render('site/categories/souscategories1.html.twig', [
        'content' => $content,
        'sousCategories' => $sousCategories1,
        'articlesCountBySousCategorie1' => $articlesCountBySousCategorie1,
        'category' => $category,
        'countSousCategories2' => $countSousCategories2,
    ]);
}

#[Route('/ville', name: 'sous_categories2glob_show')]
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


    return $this->render('site/categories/souscategories2.html.twig', [
        'content' => $content,
        'sousCategories2' => $sousCategories2,
        'articlesCountByVille' => $articlesCountByVille,
        'category' => $category,
        'sousCategory' => $sousCategory1
    ]);
}

}
