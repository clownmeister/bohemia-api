<?php

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\RoleHierarchy;
use ClownMeister\BohemiaApi\Repository\RoleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class RoleHierarchyCrudController extends AbstractCrudController
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public static function getEntityFqcn(): string
    {
        return RoleHierarchy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $availableRoles = $this->roleRepository->getChoices();

        return [
            ChoiceField::new('parentRole')
                ->setChoices($availableRoles),
            ChoiceField::new('includedRoles')
                ->allowMultipleChoices()
                ->autocomplete()
                ->setChoices($availableRoles)
                ->renderAsBadges(),
        ];
    }
}
