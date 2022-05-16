<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Repository;

use ClownMeister\BohemiaApi\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Role>
 *
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    public function add(Role $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getChoices(): array
    {
        return $this->toArray($this->findAll());
    }

    public function getDefault(): array
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('r.id, r.is_default')
            ->from('Role', 'r')
            ->where('r.is_default = 1')
            ->getQuery();

        return $this->toArray($query->getResult());
    }

    /**
     * @param Role[] $items
     *
     * @return array<string, string>
     */
    private function toArray(array $items): array
    {
        $result = [];
        foreach ($items as $role) {
            $result[$role->getName()] = $role->getId();
        }
        return $result;
    }
}
