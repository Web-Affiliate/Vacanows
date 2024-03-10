<?php
namespace App\Controller;

use App\Entity\SousCategories2;
use App\Entity\Article;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReponseSelectController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/selection-souscategories2', name: 'selection_souscategories2')]
    public function selectSousCategories2(Request $request): JsonResponse
    {
        $sousCategories2 = $this->entityManager->getRepository(SousCategories2::class)->findAll();

        $data = [];
        foreach ($sousCategories2 as $sousCategorie2) {
            $data[] = [
                'id' => $sousCategorie2->getId(),
                'text' => $sousCategorie2->getNom(),
            ];
        }

        return new JsonResponse($data);
    }

}
