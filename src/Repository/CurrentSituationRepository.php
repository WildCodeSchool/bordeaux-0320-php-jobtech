<?php

namespace App\Repository;

use App\Entity\CurrentSituation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrentSituation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentSituation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentSituation[]    findAll()
 * @method CurrentSituation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentSituationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentSituation::class);
    }

    // /**
    //  * @return CurrentSituation[] Returns an array of CurrentSituation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurrentSituation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
