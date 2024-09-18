<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use App\Entity\Articles;
use App\Entity\SousCategories1;
use App\Entity\Categories;
use App\Entity\SousCategories2;
use App\Entity\Guides;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Service\CategoryCache;


class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(CategoryCache $categoryCache, Request $request): Response
    {

        $cookieConsent = $request->cookies->get('cookieConsent');

        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

        $lastArticles = $this->entityManager->getRepository(Articles::class)->findBy([], ['id' => 'DESC'], 4);
        $offset = count($lastArticles);

        $currentDate = new \DateTime();
        $categoriesToShow = $categoryCache->getCategoriesForToday();

        $categoriesToShowBySousCategory = array_slice($categoriesToShow, 0, 3);
        $sousCategoriesToShow = [];
        $categorySlug = null;
        $sousCategorySlug = null;
        foreach ($categoriesToShowBySousCategory as $category) {
            $sousCategories = $this->entityManager->getRepository(SousCategories1::class)->findBy(['categories' => $category]);

            if (!empty($sousCategories)) {
                shuffle($sousCategories);
                $selectedSousCategory = reset($sousCategories);
                $sousCategoriesToShow[] = $selectedSousCategory;

                $categorySlug = $category->getSlug();
                $sousCategorySlug = $selectedSousCategory->getSlug();
            }
        }


        $totalArticles = $this->entityManager->getRepository(Articles::class)->countTotalArticles();

        $sousCategories1Repository = $this->entityManager->getRepository(SousCategories1::class);
        $articlesCountBySousCategorie1 = $sousCategories1Repository->countArticlesBySousCategorie1();

        $guides = $this->entityManager->getRepository(Guides::class)->findAll();
        // $sousCategorie2Id = $this->entityManager->getRepository(SousCategories2::class)->find($sousCategorie2Id);
        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }
        $data = [
            'content' => $content,
            'categoriesToShow' => $categoriesToShow,
            'sousCategoriesToShow' => $sousCategoriesToShow,
            'lastArticles' => $lastArticles,
            'categorySlug' => $categorySlug,
            'sousCategorySlug' => $sousCategorySlug,
            'image_header' => $content->getImageHeader(),
            'image_header2' => $content->getImageHeader2(),
            'image_header3' => $content->getImageHeader3(),
            'image_header4' => $content->getImageHeader4(),
            // meta
            'meta' => $content->getMeta(),
            'meta_description' => $content->getMetaDescription(),
            'meta_subject' => $content->getMetaSubject(),
            'meta_author' => $content->getMetaAuthor(),
            'meta_category' => $content->getMetaCategory(),
            'meta_og_description' => $content->getMetaOgDescription(),
            'meta_og_title' => $content->getMetaOgTitle(),
            'meta_canonical' => $content->getMetaCanonical(),
            'meta_image' => $content->getMetaImage(),
            // end meta
            'logo' => $content->getLogo(),
            'titre_header' => $content->getTitreHeader(),
            'paragraph_header' => $content->getParagraphHeader(),
            'placeholder_search' => $content->getPlaceholderSearch(),
            'titre_1' => $content->getTitre1(),
            'paragraph_1' => $content->getParagraph1(),
            'image_1' => $content->getImage1(),
            'image_1_no_border' => $content->getImage1NoBorder(),
            'titre_2' => $content->getTitre2(),
            'paragraph_2' => $content->getParagraph2(),
            'bouton_1' => $content->getBouton1(),
            'titre_3' => $content->getTitre3(),
            'paragraph_3' => $content->getParagraph3(),
            'sous_titre_1' => $content->getSousTitre1(),
            'paragraph_4' => $content->getParagraph4(),
            'sous_titre_2' => $content->getSousTitre2(),
            'paragraph_5' => $content->getParagraph5(),
            'sous_titre_3' => $content->getSousTitre3(),
            'paragraph_6' => $content->getParagraph6(),
            'titre_recommandation' => $content->getTitreRecommandation(),
            'titre_new_recommandation' => $content->getTitreNewRecommandation(),
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
            'total' => $totalArticles,
            'offset' => $offset,
            'articlesCountBySousCategorie1' => $articlesCountBySousCategorie1,
            'guides' => $guides,
            // 'sousCategorie2Id' => $sousCategorie2Id,
            'showCookiePopup' => $data['showCookiePopup'],
        ];

        return $this->render('site/home/index.html.twig', $data);
        }
    }
