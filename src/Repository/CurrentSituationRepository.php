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
}
