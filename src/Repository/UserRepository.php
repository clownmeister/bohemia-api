<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Repository;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\DuplicateUserException;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    public function loadUserByIdentifier(string $identifier): ?User
    {
        try {
            $user = $this->getEntityManager()->createQueryBuilder()
                ->select('u')
                ->from('App:Entity\User', 'u')
                ->where('u.username = :username')
                ->getQuery()
                ->setParameter('username', $identifier)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $exception) {
            throw new DuplicateUserException(previous: $exception);
        }

        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        return $user;
    }

    public function loadUserByUsername(string $username): User
    {
        return $this->loadUserByIdentifier($username);
    }
}
