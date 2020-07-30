<?php

namespace App\Repository;

use App\Entity\CurriculumVitae;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurriculumVitae|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurriculumVitae|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurriculumVitae[]    findAll()
 * @method CurriculumVitae[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurriculumVitaeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurriculumVitae::class);
    }
}
