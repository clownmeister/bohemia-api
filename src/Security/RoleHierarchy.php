<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Security;

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
        return [];

//        $roles = $this->entityManager->createQueryBuilder()
//            ->select('rh')
//            ->from('App:Entity\RoleHierarchy', 'rh')
//            ->getQuery()
//            ->getResult();

//        $role = $roles[0];
//        dump($role);
//        dump($roles);die;
//        if (!$role instanceof RoleHierarchyEntity) {
//            throw new InvalidEntityTypeException();
//        }


    }
}
