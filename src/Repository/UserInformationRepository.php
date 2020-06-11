<?php

namespace App\Repository;

use App\Entity\UserInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserInformation[]    findAll()
 * @method UserInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserInformation::class);
    }
}
