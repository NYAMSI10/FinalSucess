<?php

namespace App\Repository;

use App\Entity\Cotisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cotisation>
 *
 * @method Cotisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cotisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cotisation[]    findAll()
 * @method Cotisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CotisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cotisation::class);
    }


public function  CotisationByTeacher($user): int
{
    return $this->createQueryBuilder('c')
        ->select('SUM(c.somme)')
        ->andWhere('c.usercotisation = :user')
        ->setParameter('user', $user)
        ->getQuery()
        ->getSingleScalarResult();

}
    public function  CotisationByMontant($somme): int
    {
        return $this->createQueryBuilder('c')
            ->select('SUM(c.somme)')
            ->andWhere('c.somme = :somme')
            ->setParameter('somme', $somme)
            ->getQuery()
            ->getSingleScalarResult();

    }


}
