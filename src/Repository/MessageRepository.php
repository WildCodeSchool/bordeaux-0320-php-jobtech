<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\Company;
use App\Entity\Gender;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getAllContactCandidate()
    {
        return $this->createQueryBuilder('m')
            ->select('u.id')
            ->addSelect('c.surname surname')
            ->addSelect('c.firstName firstName')
            ->addSelect('g.acronym gender')
            ->addSelect('SUM(m.isNew) news')
            ->join(User::class, 'u', Join::WITH, 'u.id = m.contact')
            ->join(Candidate::class, 'c', Join::WITH, 'c.id = u.candidate')
            ->join(Gender::class, 'g', Join::WITH, 'g.id = c.gender')
            ->where('u.candidate IS NOT NULL')
            ->orderBy('surname', 'ASC')
            ->groupBy('m.contact')
            ->getQuery()
            ->getResult();
    }

    public function getAllContactCompanies()
    {
        return $this->createQueryBuilder('m')
            ->select('u.id')
            ->addSelect('c.name name')
            ->addSelect('SUM(m.isNew) news')
            ->join(User::class, 'u', Join::WITH, 'u.id = m.contact')
            ->join(Company::class, 'c', Join::WITH, 'c.id = u.company')
            ->where('u.company IS NOT NULL')
            ->orderBy('name', 'ASC')
            ->groupBy('m.contact')
            ->getQuery()
            ->getResult();
    }

    public function resetNew(User $user)
    {
        return $this->createQueryBuilder('m')
            ->update('App\Entity\Message', 'm')
            ->set('m.isNew', ':status')
            ->setParameter(':status', false)
            ->where('m.contact = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }
}
