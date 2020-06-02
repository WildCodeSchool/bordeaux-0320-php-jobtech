<?php

namespace App\Repository;

use App\Entity\Radius;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Radius|null find($id, $lockMode = null, $lockVersion = null)
 * @method Radius|null findOneBy(array $criteria, array $orderBy = null)
 * @method Radius[]    findAll()
 * @method Radius[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RadiusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Radius::class);
    }

    // /**
    //  * @return Radius[] Returns an array of Radius objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Radius
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
