<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Security;

use ClownMeister\BohemiaApi\Entity\Role;
use ClownMeister\BohemiaApi\Entity\RoleHierarchy as RoleHierarchyEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Role\RoleHierarchy as SymfonyRoleHierarchy;

final class RoleHierarchy extends SymfonyRoleHierarchy
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct($this->buildRolesHierarchy());
    }

    private function buildRolesHierarchy(): array
    {
        $result = [];
        $rows = $this->entityManager->createQueryBuilder()
            ->select('rh')
            ->from('App:Entity\RoleHierarchy', 'rh')
            ->leftJoin('rh.parentRole', 'pr')
            ->innerJoin('rh.roleCollection', 'rc')
            ->getQuery()
            ->getResult();

        foreach ($rows as $roleHierarchy) {
            /** @var RoleHierarchyEntity $roleHierarchy */
            $result[$roleHierarchy->getParentRole()->getName()] = array_map(
                function (Role $role): string {
                    return $role->getName();
                },
                $roleHierarchy->getRoleCollection()->toArray()
            );
        }

        return $result;
    }
}
