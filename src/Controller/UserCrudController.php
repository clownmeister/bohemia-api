<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Repository\RoleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class UserCrudController extends AbstractCrudController
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        dump($this->roleRepository->findAll());
        dump($this->roleRepository->getChoices());
        die();
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->setDisabled(),
            TextField::new('username')
                ->hideWhenCreating()
                ->setDisabled(),
            EmailField::new('email')
                ->setRequired(true),
            TextField::new('firstname')
                ->setRequired(true),
            TextField::new('lastname')
                ->setRequired(true),
            TextField::new('password')
                ->hideOnDetail()
                ->setRequired(true),
            TelephoneField::new('phone')
                ->setRequired(false),
            CountryField::new('country')
                ->setRequired(false),
            TextField::new('state')
                ->setRequired(false),
            TextField::new('city')
                ->setRequired(false),
            TextField::new('street')
                ->setRequired(false),
            TextField::new('zip')
                ->setRequired(false),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->autocomplete()
                ->setChoices($this->roleRepository->getChoices())
                ->renderAsNativeWidget()

        ];
    }
}
