<?php

namespace App\Repository;

use App\Entity\PrimeObtenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrimeObtenu>
 *
 * @method PrimeObtenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrimeObtenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrimeObtenu[]    findAll()
 * @method PrimeObtenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrimeObtenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrimeObtenu::class);
    }

//    /**
//     * @return PrimeObtenu[] Returns an array of PrimeObtenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrimeObtenu
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
