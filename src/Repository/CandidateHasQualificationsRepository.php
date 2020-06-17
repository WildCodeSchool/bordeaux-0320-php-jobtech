<?php

namespace App\Repository;

use App\Entity\CandidateHasQualifications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CandidateHasQualifications|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateHasQualifications|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateHasQualifications[]    findAll()
 * @method CandidateHasQualifications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateHasQualificationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidateHasQualifications::class);
    }
}
