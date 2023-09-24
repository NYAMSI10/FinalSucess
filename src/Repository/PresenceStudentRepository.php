<?php

namespace App\Repository;

use App\Entity\PresenceStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresenceStudent>
 *
 * @method PresenceStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresenceStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresenceStudent[]    findAll()
 * @method PresenceStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresenceStudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresenceStudent::class);
    }

//    /**
//     * @return PresenceStudent[] Returns an array of PresenceStudent objects
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


        public function AbscenceByDate($clas,$perio): array
        {
            return $this->createQueryBuilder('p')
                ->select('p.createdAt')
                ->andWhere('p.classepresence =:clas')
                ->andWhere('p.periodepresence =:perio')
                ->setParameter('clas', $clas)
                ->setParameter('perio', $perio)
                ->groupBy('p.createdAt ')
                ->getQuery()
                ->getResult();

        }








//    public function findOneBySomeField($value): ?PresenceStudent
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
