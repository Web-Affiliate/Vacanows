<?php

namespace App\Repository;

use App\Entity\SousCategories2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousCategories2>
 *
 * @method SousCategories2|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCategories2|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCategories2[]    findAll()
 * @method SousCategories2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCategories2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategories2::class);
    }

//    /**
//     * @return SousCategories2[] Returns an array of SousCategories2 objects
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

//    public function findOneBySomeField($value): ?SousCategories2
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
