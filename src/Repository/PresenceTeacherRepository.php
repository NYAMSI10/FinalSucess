<?php

namespace App\Repository;

use App\Entity\PresenceTeacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresenceTeacher>
 *
 * @method PresenceTeacher|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresenceTeacher|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresenceTeacher[]    findAll()
 * @method PresenceTeacher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresenceTeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresenceTeacher::class);
    }

//    /**
//     * @return PresenceTeacher[] Returns an array of PresenceTeacher objects
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

//    public function findOneBySomeField($value): ?PresenceTeacher
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
