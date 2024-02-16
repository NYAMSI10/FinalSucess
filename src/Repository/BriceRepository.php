<?php

namespace App\Repository;

use App\Entity\Brice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Brice>
 *
 * @method Brice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brice[]    findAll()
 * @method Brice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brice::class);
    }

//    /**
//     * @return Brice[] Returns an array of Brice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Brice
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
