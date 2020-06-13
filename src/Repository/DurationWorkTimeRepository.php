<?php

namespace App\Repository;

use App\Entity\DurationWorkTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DurationWorkTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method DurationWorkTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method DurationWorkTime[]    findAll()
 * @method DurationWorkTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DurationWorkTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DurationWorkTime::class);
    }

    // /**
    //  * @return DurationWorkTime[] Returns an array of DurationWorkTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DurationWorkTime
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
