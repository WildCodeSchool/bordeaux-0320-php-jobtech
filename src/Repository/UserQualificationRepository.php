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
}
