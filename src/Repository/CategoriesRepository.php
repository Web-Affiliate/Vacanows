<?php

namespace App\Repository;

use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categories>
 *
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categories::class);
    }

//    /**
//     * @return Categories[] Returns an array of Categories objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

public function findCategoriesWithSubcategories($limit)
{
    return $this->createQueryBuilder('c')
        ->leftJoin('c.sousCategories1s', 'sousCategory')
        ->groupBy('c.id')
        ->having('COUNT(sousCategory) > 0')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}


public function findNextCategoriesByDate(\DateTime $date, $limit)
{
    return $this->createQueryBuilder('c')
        ->where('c.createdAt < :date')
        ->setParameter('date', $date)
        ->orderBy('c.createdAt', 'ASC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}

//    public function findOneBySomeField($value): ?Categories
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
