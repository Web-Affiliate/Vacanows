<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use App\ENtity\Articles;
use App\Entity\SousCategories1;
use App\Entity\Categories;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $content = $this->entityManager->getRepository(Content::class)->findOneBy([]);

           $lastArticles = $this->entityManager->getRepository(Articles::class)->findBy([], ['id' => 'DESC'], 4);

        $lastSousCategories = $this->entityManager->getRepository(SousCategories1::class)->findBy([], ['id' => 'DESC'], 3);

        $lastCategories = $this->entityManager->getRepository(Categories::class)->findBy([], ['id' => 'DESC'], 4);

        $navbar = [];
        for($i=1; $i<=5; $i++){
            $navbar[] = $content->{"getNavbar$i"}();
        }

        $data = [
            'content' => $content,
            'navbar' => $navbar,
            'lastSousCategories' => $lastSousCategories,
            'lastCategories' => $lastCategories,
            'lastArticles' => $lastArticles,
            'image_header' => $content->getImageHeader(),
            'meta' => $content->getMeta(),
            'logo' => $content->getLogo(),
            'titre_header' => $content->getTitreHeader(),
            'paragraph_header' => $content->getParagraphHeader(),
            'placeholder_search' => $content->getPlaceholderSearch(),
            'titre_1' => $content->getTitre1(),
            'paragraph_1' => $content->getParagraph1(),
            'image_1' => $content->getImage1(),
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
            'titre_4' => $content->getTitre4(),
            'paragraph_7' => $content->getParagraph7(),
            'sous_titre_4' => $content->getSousTitre4(),
            'paragraph_8' => $content->getParagraph8(),
            'sous_titre_5' => $content->getSousTitre5(),
            'paragraph_9' => $content->getParagraph9(),
            'sous_titre_6' => $content->getSousTitre6(),
            'paragraph_10' => $content->getParagraph10(),
            'titre_new_recommandation' => $content->getTitreNewRecommandation(),
            'instagram_link' => $content->getInstagramLink(),
            'tiktok_link' => $content->getTiktokLink(),
            'facebook_link' => $content->getFacebookLink(),
        ];

        return $this->render('site/home/index.html.twig', $data);
    }
}
