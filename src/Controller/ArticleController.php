<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\SousCategories1;
use App\Entity\SousCategories2;
use App\Entity\Categories;
use App\Entity\Content;
use App\Entity\Guides;
use App\Entity\Affiliate;
use App\Entity\Comment;
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
    public function show(Articles $article, Request $request): Response
    {
        $cookieConsent = $request->cookies->get('cookieConsent');
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);
        $navbar = [];
        for($i=1; $i<=5; $i++){
            $navbar[] = $content->{"getNavbar$i"}();
        }

        $affiliateLinks = [];

        $category = $article->getSousCategories2()->getSousCategorie1()->getCategories();

        $lastArticles = $this->entityManager->getRepository(Articles::class)->findBy([], ['id' => 'DESC'], 4);
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

        $comments = $this->entityManager->getRepository(Comment::class)
        ->findBy(['article' => $article], ['date_creation' => 'DESC'], 4);

        $affiliateLinksForCurrentVille = [];
        foreach ($villesRandom as $ville) {
            $notes = [];
            for ($i = 1; $i <= 12; $i++) {
                $propertyName = 'NoteTabItem' . $i;
                $notes[$i] = $ville->{'get' . ucfirst($propertyName)}();
            }
            $affiliateLinks = $this->entityManager->getRepository(Affiliate::class)->findBySousCategories2AndGuide($ville, $article->getGuides());

            $randomAffiliateLink = null;
            if (!empty($affiliateLinks)) {
                $randomAffiliateLink = $affiliateLinks[array_rand($affiliateLinks)]->getLien();
            }

            $affiliateLinksForCurrentVille[] = $randomAffiliateLink ?? '';

            $ville->notes = $notes;
        }

        $articlesRepository = $this->entityManager->getRepository(Articles::class);

        $articlesWithSameSousCategories2 = $articlesRepository->findRandomArticlesBySousCategories2($article, 3);

        $guides = $this->entityManager->getRepository(Guides::class)->findAll();

        $date = $article->getCreatedDate();

        if ($cookieConsent) {
            $data['showCookiePopup'] = false;
        } else {
            $data['showCookiePopup'] = true;
        }

        return $this->render('site/article/index.html.twig', [
            'article' => $article,
            'total' => $totalArticles,
            'content' => $content,
            'navbar' => $navbar,
            'lastArticles' => $lastArticles,
            'comments' => $comments,
            'currentPage' => 1,
        'totalPages' => ceil($this->entityManager->getRepository(Comment::class)->count(['article' => $article]) / 4),
            'slug' => $article->getSlug(),
            'titre_1' => $article->getTitre1(),
            'sites' => $article->getSites(),
            'user_timezone' => 'Europe/Paris',
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
            'showCookiePopup' => $data['showCookiePopup'],
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
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

/**
 * @Route("/comment/{id}", name="delete_comment", methods={"DELETE"})
 */
#[Route('/comment/{id}', name: 'delete_comment', methods: ['DELETE'])]
public function deleteComment(?Comment $comment): JsonResponse
{
    if (!$comment) {
        return new JsonResponse(['success' => false, 'message' => 'Comment not found.'], 404);
    }

    if ($this->getUser() !== $comment->getUser()) {
        return new JsonResponse(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    $this->entityManager->remove($comment);
    $this->entityManager->flush();

    return new JsonResponse([
        'success' => true,
        'commentId' => $comment->getId(),
        'username' => $this->getUser()->getUsername(),
    ]);
}



/**
 * @Route("/article/{slug}/comment", name="post_comment", methods={"POST"})
 */
#[Route('/article/{slug}/comment', name: 'post_comment', methods: ['POST'])]
public function postComment(Articles $article, Request $request): JsonResponse
{
    $data = json_decode($request->getContent(), true);
    $user = $this->getUser();

    if (!$user) {
        return new JsonResponse(['success' => false, 'message' => 'You must be logged in to post a comment.']);
    }

    if (isset($data['comment']) && !empty(trim($data['comment']))) {
        $comment = new Comment();
        $comment->setUser($user);
        $comment->setArticle($article);
        $comment->setComment($data['comment']);
        $timezone = new \DateTimeZone('Europe/Paris');
        $comment->setDateCreation(new \DateTime('now', new \DateTimeZone('UTC')));
        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'commentId' => $comment->getId(),
            'comment' => $comment->getComment(),
            'username' => $user->getUsername(),
            'createdAt' => $comment->getDateCreation()->format(\DateTime::ISO8601)
        ]);
    }

    return new JsonResponse(['success' => false, 'message' => 'Comment cannot be empty.']);
}


/**
 * @Route("/article/{slug}/comments/{page}", name="get_comments", methods={"GET"}, defaults={"page": 1})
 */
#[Route('/article/{slug}/comments/{page}', name: 'get_comments', methods: ['GET'], defaults: ['page' => 1])]
public function getComments(Articles $article, int $page): JsonResponse
{
    $limit = 4;
    $offset = ($page - 1) * $limit;

    $comments = $this->entityManager->getRepository(Comment::class)
        ->findBy(['article' => $article], ['date_creation' => 'DESC'], $limit, $offset);

    $totalComments = $this->entityManager->getRepository(Comment::class)
        ->count(['article' => $article]);

    $totalPages = ceil($totalComments / $limit);
    $commentsArray = [];
    $userTimezone = 'Europe/Paris';

    foreach ($comments as $comment) {
        $commentsArray[] = [
            'username' => $comment->getUser()->getUsername(),
            'comment' => $comment->getComment(),
            'elapsedTime' => $comment->getElapsedTime($userTimezone),
        ];
    }

    return new JsonResponse([
        'comments' => $commentsArray,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ]);
}

}
