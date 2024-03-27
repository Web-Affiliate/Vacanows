<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\SousCategories1;
use App\Entity\SousCategories2;
use App\Entity\Categories;
use App\Entity\Content;
use App\Entity\Guides;
use App\Entity\Affiliate;
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

        $affiliateLinks = [];

        $category = $article->getSousCategories2()->getSousCategorie1()->getCategories();

        $lastArticles = $this->entityManager->getRepository(Articles::class)->findArticlesExcludingCurrent($article, 4);

        $totalArticles = $this->entityManager->getRepository(Articles::class)->countTotalArticles();
        $offset = count($lastArticles);

        $hasMoreArticles = count($lastArticles) === 4;
        $limit = 3;

        $sousCategories2 = $article->getSousCategories2();
        $sousCategories1 = null;
        if ($sousCategories2 !== null) {
            $sousCategories1 = $sousCategories2->getSousCategorie1();
        }

        $villesRepository = $this->entityManager->getRepository(SousCategories2::class);
        $villesRandom = [];
        $currentArticle = $article;

        if ($sousCategories1 !== null) {
            $villesRandom = $villesRepository->findRandomVillesBySousCategories1($sousCategories1, $article, 3);
        }

        foreach ($villesRandom as $ville) {
            $notes = [];
            for ($i = 1; $i <= 12; $i++) {
                $propertyName = 'NoteTabItem' . $i;
                $notes[$i] = $ville->{'get' . ucfirst($propertyName)}();
            }
            // Récupérer tous les liens d'affiliation pour cette ville
            $affiliateLinks = $this->entityManager->getRepository(Affiliate::class)->findBySousCategories2AndGuide($ville, $article->getGuides());

            // Sélectionner un lien d'affiliation aléatoire parmi ceux disponibles
            $randomAffiliateLink = null;
            if (!empty($affiliateLinks)) {
                $randomAffiliateLink = $affiliateLinks[array_rand($affiliateLinks)]->getLien();
            }

            // Ajouter le lien d'affiliation (ou une chaîne vide si aucun lien disponible) à la liste des liens
            $affiliateLinksForCurrentVille[] = $randomAffiliateLink ?? '';

            $ville->notes = $notes;
        }

        $articlesRepository = $this->entityManager->getRepository(Articles::class);

        $articlesWithSameSousCategories2 = $articlesRepository->findRandomArticlesBySousCategories2($article, 3);

        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        $date = $article->getCreatedDate();

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
            'sous_categories_1' => $sousCategories1,
            'categories' => $category,
            'date' => $date,
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
            'guides' => $guides,
            'meta' => $article->getMeta(),
            'meta_description' => $article->getMetaDescription(),
            'meta_subject' => $article->getMetaSubject(),
            'meta_author' => $article->getMetaAuthor(),
            'meta_category' => $article->getMetaCategory(),
            'meta_og_description' => $article->getMetaOgDescription(),
            'meta_og_title' => $article->getMetaOgTitle(),
            'meta_canonical' => $article->getMetaCanonical(),
            'meta_image' => $article->getMetaImage(),
            'offset' => $offset,
            'hasMoreArticles' => $hasMoreArticles,
            'limit' => $limit,
            'villesRandom' => $villesRandom,
            'articlesWithSameSousCategories2' => $articlesWithSameSousCategories2,
            'currentArticle' => $currentArticle,
            'affiliateLinks' => $affiliateLinksForCurrentVille,
        ]);
    }

  /**
 * @Route("/load-more-articles", name="load_more_articles", methods={"GET"})
 */
#[Route('/load-more-articles', name: 'load_more_articles', methods: ['GET'])]
public function loadMoreArticles(Request $request): Response
{
    $offset = $request->query->get('offset', 0);
    $excludedArticles = json_decode($request->query->get('excludedArticles', '[]'));
    $references = $this->entityManager->getRepository(Articles::class)->findNextArticles($offset, 3, $excludedArticles);

    return $this->render('site/article/loadMore.html.twig', [
        'articles' => $references,
    ]);
}


}
