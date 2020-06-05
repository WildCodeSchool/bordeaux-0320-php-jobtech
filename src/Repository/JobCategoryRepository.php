<?php

namespace App\Repository;

use App\Entity\JobCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobCategory[]    findAll()
 * @method JobCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobCategory::class);
    }

    // /**
    //  * @return JobCategory[] Returns an array of JobCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobCategory
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
