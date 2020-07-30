<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     * @param UserInterface $user
     * @param string $newEncodedPassword
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findAllContact()
    {
        $request = $this->createQueryBuilder('u')
            ->select('u', 'c', 'co')
            ->join('u.messages', 'm')
            ->leftJoin('u.candidate', 'c')
            ->leftJoin('u.company', 'co')
            ->groupBy('m.contact');

        return $request->getQuery()->getResult();
    }

    public function findAllCandidate()
    {
        $request = $this->createQueryBuilder('u')
            ->select('u', 'c')
            ->innerJoin('u.candidate', 'c')
            ->groupBy('u.id');

        return $request->getQuery()->getResult();
    }

    public function findAllCompany()
    {
        $request = $this->createQueryBuilder('u')
            ->select('u', 'co')
            ->innerJoin('u.company', 'co')
            ->groupBy('u.id');

        return $request->getQuery()->getResult();
    }
}
