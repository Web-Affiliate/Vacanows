<?php

namespace App\Repository;

use App\Entity\SousCategories1;
use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousCategories1>
 *
 * @method SousCategories1|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCategories1|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCategories1[]    findAll()
 * @method SousCategories1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCategories1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategories1::class);
    }

//     public function findSousCategories1ByDateAndByCategory(\DateTime $date, Categories $category, $limit)
// {
//     return $this->createQueryBuilder('s')
//         ->where('s.categories = :category')
//         ->andWhere('s.createdAt < :date')
//         ->setParameter('category', $category)
//         ->setParameter('date', $date)
//         ->orderBy('s.createdAt', 'ASC')
//         ->setMaxResults($limit)
//         ->getQuery()
//         ->getResult();
// }

//    /**
//     * @return SousCategories1[] Returns an array of SousCategories1 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SousCategories1
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
