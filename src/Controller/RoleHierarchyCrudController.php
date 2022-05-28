<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\RoleHierarchy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

final class RoleHierarchyCrudController extends AbstractCrudController
{
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('parentRole')
                ->setFormTypeOption('choice_label', 'name')
                ->setFormTypeOption('by_reference', true),
            AssociationField::new('roleCollection', 'Roles')
                ->setFormTypeOption('choice_label', 'name')
                ->setFormTypeOption('by_reference', false),
        ];
    }

    public static function getEntityFqcn(): string
    {
        return RoleHierarchy::class;
    }
}
