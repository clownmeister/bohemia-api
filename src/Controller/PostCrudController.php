<?php
declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidEntityTypeException;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Field\CKEditorField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\String\Slugger\SluggerInterface;

final class PostCrudController extends AbstractCrudController
{
    public function __construct(private SluggerInterface $slugger)
    {

    }

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
        //TODO: get user from auto-wire. Class should match afterwards
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $post = new Post();
        $post->setAuthorId($user->getId());
        return $post;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $post = $entityInstance;
        if (!$post instanceof Post) {
            throw new InvalidEntityTypeException();
        }

        $post->setSlug($this->slugger->slug($post->getSlug())->toString());

        parent::updateEntity($entityManager, $post);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $post = $entityInstance;
        if (!$post instanceof Post) {
            throw new InvalidEntityTypeException();
        }

        if ($post->getSlug() === '') {
            $post->setSlug($this->slugger->slug($post->getTitle())->toString());
        }

        parent::persistEntity($entityManager, $post);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('id')
                ->setDisabled()
                ->hideWhenCreating()
                ->hideOnIndex(),
            TextField::new('title'),
            TextField::new('slug')
                ->hideWhenCreating(),
            CKEditorField::new('html')
        ];
    }
}
