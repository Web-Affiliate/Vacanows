<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<Articles>
 *
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function findNextArticles($offset, $limit)
    {
       $results = $this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM App\Entity\Articles a
                ORDER BY a.id DESC'

            )
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getResult();
        return $results;
}

public function findNextArticlesExcludingCurrent($currentArticleId, int $offset, int $limit)
{
    return $this->createQueryBuilder('a')
        ->andWhere('a.id != :currentArticleId')
        ->setParameter('currentArticleId', $currentArticleId)
        ->orderBy('a.id', 'DESC')
        ->setFirstResult($offset)
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}


public function findArticlesExcludingCurrent(Articles $currentArticle, int $limit)
{
    return $this->createQueryBuilder('a')
        ->andWhere('a != :currentArticle')
        ->setParameter('currentArticle', $currentArticle)
        ->orderBy('a.id', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}

public function findRandomArticlesBySousCategories2(Articles $currentArticle, int $limit)
{
    $articles = $this->createQueryBuilder('a')
        ->andWhere('a.sous_categories_2 = :sousCategories2')
        ->andWhere('a != :currentArticle')
        ->setParameter('sousCategories2', $currentArticle->getSousCategories2())
        ->setParameter('currentArticle', $currentArticle)
        ->getQuery()
        ->getResult();

    shuffle($articles);

    return array_slice($articles, 0, $limit);
}


public function countTotalArticles(): int
{
    return $this->createQueryBuilder('a')
        ->select('COUNT(a.id)')
        ->getQuery()
        ->getSingleScalarResult();
}

// TEMPS LECTURE

public function findTempsLectureMin(): int
{
    return $this->createQueryBuilder('a')
        ->select('MIN(a.temps_lecture)')
        ->getQuery()
        ->getSingleScalarResult();
}

public function findTempsLectureMax(): int
{
    return $this->createQueryBuilder('a')
        ->select('MAX(a.temps_lecture)')
        ->getQuery()
        ->getSingleScalarResult();
}

public function findTempsLectureMinBySousCategorie1()
{
    return $this->createQueryBuilder('a')
        ->select('MIN(a.temps_lecture)')
        ->join('a.sous_categories_2', 's')
        ->andWhere('s.sous_categorie_1 = :sousCategory1')
        ->setParameter('sousCategory1', $sousCategory1)
        ->getQuery()
        ->getSingleScalarResult();
}

// public function findTempsLectureMaxBySousCategorie1()
// {
//     return $this->createQueryBuilder('a')
//         ->select('MAX(a.temps_lecture)')
//         ->join('a.sous_categories_2', 's')
//         ->andWhere('s.sous_categorie_1 = :sousCategory1')
//         ->setParameter('sousCategory1', $sousCategory1)
//         ->getQuery()
//         ->getSingleScalarResult();
// }

// public function findTempsLectureBySousCategory2($sousCategory2)
// {
//     return $this->createQueryBuilder('a')
//         ->select('a.temps_lecture')
//         ->andWhere('a.sous_categories_2 = :sousCategory2')
//         ->setParameter('sousCategory2', $sousCategory2)
//         ->getQuery()
//         ->getResult();
// }


//    /**
//     * @return Articles[] Returns an array of Articles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Articles
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
