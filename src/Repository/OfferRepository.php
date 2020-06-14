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

    /**
     * Find all offers and add the interval between the creation and now.
     * @param array|null $orderBy
     * @param int $limit
     * @param int $offset
     * @return Offer[]
     */
    public function findAllOffersAndAddInterval(array $orderBy = null, int $limit = null, int $offset = null): array
    {
        $request = $this->createQueryBuilder('offer')
            ->select('offer', 'job', 'jobCategory', 'company', 'contract', 'duration')
            ->join('offer.job', 'job')
            ->join('offer.jobCategory', 'jobCategory')
            ->join('offer.company', 'company')
            ->join('offer.contract', 'contract')
            ->join('offer.duration', 'duration');

        if ($orderBy) {
            $first = true;
            foreach ($orderBy as $key => $order) {
                if ($first) {
                    $request->orderBy('offer.' . $key, $order);
                    $first = false;
                } else {
                    $request->addOrderBy('offer.' . $key, $order);
                }
            }
        }
        if ($limit) {
            $request->setMaxResults($limit);
        }
        if ($offset) {
            $request->setFirstResult($offset);
        }

        $offers = $request->getQuery()->getResult();

        foreach ($offers as $offer) {
            $offer->setInterval($offer->getCreatedAt());
        }

        return $offers;
    }

    /**
     * Get the total number of offers posted on JobTech.
     * @return integer
     */
    public function getTotalOfOffers(): int
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
            $offer->setInterval($offer->getCreatedAt());
        }
        return $offers;
    }
}
