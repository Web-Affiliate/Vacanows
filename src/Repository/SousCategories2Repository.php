<?php

namespace App\Repository;

use App\Entity\SousCategories2;
use App\Entity\SousCategories1;
use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SousCategories2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategories2::class);
    }

    public function findRandomVillesBySousCategories1(
        SousCategories1 $sousCategories1,
        Articles $article,
        int $limit
    ): array {
        $villes = $this->createQueryBuilder('s')
            ->leftJoin('s.articles', 'a')
            ->where('s.sous_categorie_1 = :sousCategories1')
            ->andWhere('a.id != :article_id')
            ->andWhere('s.id != :sousCategories2_id')
            ->setParameter('sousCategories1', $sousCategories1)
            ->setParameter('article_id', $article->getId())
            ->setParameter('sousCategories2_id', $article->getSousCategories2()->getId()) // Assuming SousCategories2 is a property of the Article entity
            ->getQuery()
            ->getResult();

        shuffle($villes);

        $villesRandom = array_slice($villes, 0, $limit);

        return $villesRandom;
    }

    public function countSousCategories2BySousCategory(SousCategories1 $sousCategory1): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s)')
            ->where('s.sous_categorie_1 = :sousCategory1')
            ->setParameter('sousCategory1', $sousCategory1)
            ->getQuery()
            ->getSingleScalarResult();
    }

}

