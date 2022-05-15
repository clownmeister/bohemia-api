<?php

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Field\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud->setFormThemes(['@FOSCKEditor/Form/ckeditor_widget.html.twig', '@EasyAdmin/crud/form_theme.html.twig']);

        return $crud;
    }

    public function createEntity(string $entityFqcn)
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $post = new Post();
        $post->setAuthorId($user->getId());
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            CKEditorField::new('html'),
        ];
    }
}
