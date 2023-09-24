<?php

namespace App\Repository;

use App\Entity\EvenementObtenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EvenementObtenu>
 *
 * @method EvenementObtenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvenementObtenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvenementObtenu[]    findAll()
 * @method EvenementObtenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementObtenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvenementObtenu::class);
    }

//    /**
//     * @return EvenementObtenu[] Returns an array of EvenementObtenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EvenementObtenu
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
