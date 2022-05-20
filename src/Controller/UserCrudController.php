<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidEntityTypeException;
use ClownMeister\BohemiaApi\Repository\RoleRepository;
use ClownMeister\BohemiaApi\Security\UsernameGenerator;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserCrudController extends AbstractCrudController
{
    private const ADMIN_IDENTIFIER = 'admin';
    private bool $isNewUser = false;

    public function __construct(
        private RoleRepository $roleRepository,
        private UserPasswordHasherInterface $hasher,
        private UsernameGenerator $usernameGenerator
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function createEntity(string $entityFqcn): User
    {
        $this->isNewUser = true;

        return new User();
    }

    public function configureActions(Actions $actions): Actions
    {
        //TODO: Reset pasword modal wip
//        $setNewPasswordAction = Action::new('Reset password')
//            ->setIcon('fas fa-lock')
//            ->linkToCrudAction('resetPassword');
//        $actions->add(Crud::PAGE_INDEX, $setNewPasswordAction);

        $actions->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->displayIf(function (?User $user) {
                return $this->isGranted('ROLE_USER_REMOVE') && ($user?->getUserIdentifier() !== self::ADMIN_IDENTIFIER);
            });
        });


        return $actions;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $entityInstance;
        if (!$user instanceof User) {
            throw new InvalidEntityTypeException();
        }

        if ($this->isNewUser === true) {
            $user->setUsername($this->usernameGenerator->generate($user));
            $user->setPassword(
                $this->hasher->hashPassword(
                    $user,
                    $user->getPassword()
                ));
        }

        parent::persistEntity($entityManager, $user);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->setDisabled()
                ->hideOnIndex(),
            TextField::new('username')
                ->hideWhenCreating()
                ->setDisabled(),
            BooleanField::new('isVerified'),
            EmailField::new('email')
                ->setRequired(true),
            TextField::new('firstname')
                ->setRequired(true),
            TextField::new('lastname')
                ->setRequired(true),
            TextField::new('password')
                ->setRequired(true)
                ->onlyWhenCreating(),
            AssociationField::new('roleCollection', 'Roles')
                ->setFormTypeOption('choice_label', 'name')
                ->setFormTypeOption('by_reference', false),
            TelephoneField::new('phone')
                ->setRequired(false)
                ->hideOnIndex(),
            CountryField::new('country')
                ->setRequired(false)
                ->hideOnIndex(),
            TextField::new('state')
                ->setRequired(false)
                ->hideOnIndex(),
            TextField::new('city')
                ->setRequired(false)
                ->hideOnIndex(),
            TextField::new('street')
                ->setRequired(false)
                ->hideOnIndex(),
            TextField::new('zip')
                ->setRequired(false)
                ->hideOnIndex()
        ];
    }
}
