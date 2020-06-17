<?php

namespace App\Repository;

use App\Entity\Candidate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Candidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidate[]    findAll()
 * @method Candidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidate::class);
    }
}
