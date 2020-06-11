<?php

namespace App\Repository;

use App\Entity\Offer;
use App\Form\SearchForm;
use App\Service\DateProcessing;
use App\Service\OfferSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function findByAndAddInterval(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $offers = $this->findBy($criteria, $orderBy, $limit, $offset);
        foreach ($offers as $offer) {
            $offer->setInterval();
        }
        return $offers;
    }

    /**
     * Récupère les offres en lien avec une recherche
     * @param OfferSearch $search
     * @return Offer[]
     */
    public function findSearch(OfferSearch $search): array
    {
        $query = $this
            ->createQueryBuilder('o')
            ->select('j', 'o')
            ->join('o.job', 'j')
            ->join('o.contract', 'c');

        if (!empty($search->que)) {
            $query = $query
                ->andWhere('j.title LIKE :que')
                ->orWhere('o.city LIKE :que')
                ->orWhere('c.title LIKE :que')
                ->setParameter('que', "%{$search->que}%");
        }

        if (!empty($search->job)) {
            $query = $query
                ->andWhere('j.id IN (:job)')
                ->setParameter('job', $search->job);
        }

        if (!empty($search->contract)) {
            $query = $query
                ->andWhere('c.id IN (:contract)')
                ->setParameter('contract', $search->contract);
        }

        $offers = $query->getQuery()->getResult();
        foreach ($offers as $offer) {
            $offer->setInterval();
        }

        return $offers;
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
