<?php

namespace App\Repository;

use App\Entity\Affiliate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SousCategories2;
use App\Entity\Guides;

/**
 * @extends ServiceEntityRepository<Affiliate>
 *
 * @method Affiliate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affiliate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affiliate[]    findAll()
 * @method Affiliate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffiliateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affiliate::class);
    }


    public function findBySousCategories2AndGuide(SousCategories2 $sousCategories2, Guides $guide): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.sous_categories_2 = :sousCategories2')
            ->andWhere('a.guides = :guide')
            ->setParameter('sousCategories2', $sousCategories2)
            ->setParameter('guide', $guide)
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Affiliate[] Returns an array of Affiliate objects
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

//    public function findOneBySomeField($value): ?Affiliate
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
