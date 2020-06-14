<?php

namespace App\Repository;

use App\Entity\Offer;
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

    public function getTotalOfOffers()
    {
        return $this->createQueryBuilder('o')
            ->select('COUNT(o.title) AS offers')
            ->getQuery()
            ->getResult()[0]['offers'];
    }

    /**
     * Retrieves offers related to a search
     * @param OfferSearch $search
     * @param array $offers
     * @return Offer[]
     */
    public function findSearch(OfferSearch $search, array $offers): array
    {
        if ($search->checkIfFormIsEmpty()) {
            return $offers;
        }

        $query = $this->createQueryBuilder('o')
            ->select('j', 'o')
            ->join('o.job', 'j')
            ->join('o.contract', 'c')
            ->join('o.duration', 'd');

        if (!empty($search->query)) {
            $query
                ->andWhere('j.title LIKE :query')
                ->orWhere('o.city LIKE :query')
                ->orWhere('c.title LIKE :query')
                ->orWhere('d.title LIKE :query')
                ->setParameter('query', "%{$search->query}%");
        }

        if (!empty($search->job)) {
            $query
                ->andWhere('j.id IN (:job)')
                ->setParameter('job', $search->job);
        }

        if (!empty($search->contract)) {
            $query
                ->andWhere('c.id IN (:contract)')
                ->setParameter('contract', $search->contract);
        }

        if (!empty($search->duration)) {
            $query
                ->andWhere('d.id IN (:duration)')
                ->setParameter('duration', $search->duration);
        }

        $offers = $query->getQuery()
            ->getResult();

        foreach ($offers as $offer) {
            $offer->setInterval();
        }
        return $offers;
    }
}
