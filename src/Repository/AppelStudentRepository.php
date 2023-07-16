<?php

namespace App\Repository;

use App\Entity\AppelStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AppelStudent>
 *
 * @method AppelStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppelStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppelStudent[]    findAll()
 * @method AppelStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppelStudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppelStudent::class);
    }

//    /**
//     * @return AppelStudent[] Returns an array of AppelStudent objects
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

//    public function findOneBySomeField($value): ?AppelStudent
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
