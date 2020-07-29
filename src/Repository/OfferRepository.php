<?php

namespace App\Repository;

use App\Entity\Offer;
use App\Entity\Search\OfferSearch;
use DateTime;
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
     * Find all offers not ended and add the interval between the creation and now.
     * @param array|null $orderBy
     * @param int $limit
     * @param int $offset
     * @return Offer[]
     */
    public function findAllOffersAndAddInterval(array $orderBy = null, int $limit = null, int $offset = null): array
    {
        $request = $this->createQueryBuilder('o')
            ->where('o.endedAt > :now')
            ->setParameter('now', new DateTime())
            ->join('o.job', 'job')
            ->join('o.jobCategory', 'jobCategory')
            ->join('o.company', 'company')
            ->join('o.workTime', 'workTime');

        if ($orderBy) {
            foreach ($orderBy as $key => $order) {
                $request->addOrderBy('o.' . $key, $order);
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
            $offer->setInterval();
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
            ->where('o.endedAt > :now')
            ->setParameter('now', new DateTime())
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
            ->where('o.endedAt > :now')
            ->setParameter('now', new DateTime())
            ->join('o.job', 'j')
            ->join('o.contracts', 'c')
            ->join('o.workTime', 'wt');

        if (!empty($search->getQuery())) {
            $query
                ->andWhere('j.title LIKE :query')
                ->orWhere('o.city LIKE :query')
                ->orWhere('c.title LIKE :query')
                ->orWhere('wt.title LIKE :query')
                ->setParameter('query', "%{$search->getQuery()}%");
        }

        if ($search->getJob() !== null) {
            $query
                ->andWhere('j.id IN (:job)')
                ->setParameter('job', $search->getJob());
        }

        if ($search->getContract() !== null) {
            $query
                ->andWhere('c.id IN (:contract)')
                ->setParameter('contract', $search->getContract());
        }

        if ($search->getWorkTime() !== null) {
            $query
                ->andWhere('wt.id IN (:workTime)')
                ->setParameter('workTime', $search->getWorkTime());
        }

        $offers = $query->getQuery()->getResult();

        foreach ($offers as $offer) {
            $offer->setInterval();
        }
        return $offers;
    }
}
