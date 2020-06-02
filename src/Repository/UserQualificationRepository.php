<?php

namespace App\Repository;

use App\Entity\UserQualification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserQualification|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserQualification|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserQualification[]    findAll()
 * @method UserQualification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserQualificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserQualification::class);
    }

    // /**
    //  * @return UserQualification[] Returns an array of UserQualification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserQualification
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
