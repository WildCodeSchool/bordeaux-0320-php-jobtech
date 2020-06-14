<?php

namespace App\Repository;

use App\Entity\JobCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Count;

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

    public function getJobCategoryWithOffersNb(int $limit = null)
    {
        $request = $this->createQueryBuilder('jc')
            ->select('jc.id', 'jc.title', 'jc.icon', 'jc.identifier', 'count(o.title) AS offers')
            ->leftJoin('jc.offers', 'o')
            ->groupBy('jc.id', 'jc.title', 'jc.icon', 'jc.identifier')
            ->orderBy('offers', 'DESC');

        if ($limit) {
            $request->setMaxResults($limit);
        }

        return $request->getQuery()
            ->getResult();
    }
}
