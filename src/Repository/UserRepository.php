<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    public function TeacherByPeriode($periode): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','p')
            ->join('u.userperiode', 'p')
            ->andWhere('p.id = :periode')
            ->andWhere('u.IsTeacher = 1')
            ->setParameter('periode',$periode)
            ->getQuery()
            ->getResult();
    }

    public function studentByabsence($abscence): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','p')
            ->join('u.absenceStudents', 'p')
            ->andWhere('p.id = :abscence')
            ->setParameter('abscence',$abscence)
            ->getQuery()
            ->getResult();
    }
    public function studentByperioclasse($periode, $classe): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','p','c')
            ->join('u.userperiode', 'p')
            ->join('u.userclasse', 'c')
            ->andWhere('p.id = :periode')
            ->andWhere('c.id = :classe')
            ->andWhere('u.IsTeacher = 0')
            ->setParameter('periode',$periode)
            ->setParameter('classe',$classe)
            ->getQuery()
            ->getResult();
    }
    public function TeacherByClasse($classe): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','c')
            ->join('u.userclasse', 'c')
            ->andWhere('c.id = :classe')
            ->andWhere('u.IsTeacher = 1')
            ->setParameter('classe',$classe)
            ->getQuery()
            ->getResult();
    }
    public function StudentByPeriode($periode): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','p')
            ->join('u.userperiode', 'p')
            ->andWhere('p.id = :periode')
            ->andWhere('u.IsTeacher = 0')
            ->setParameter('periode',$periode)
            ->getQuery()
            ->getResult();
    }
    public function StudentByClasse($classe): array
    {

        return $this->createQueryBuilder('u')
            ->select('u','c')
            ->join('u.userclasse', 'c')
            ->andWhere('c.id = :classe')
            ->andWhere('u.IsTeacher = 0')
            ->setParameter('classe',$classe)
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
