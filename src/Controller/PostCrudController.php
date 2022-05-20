<?php
declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidEntityTypeException;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Field\CKEditorField;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

final class PostCrudController extends AbstractCrudController
{
    public function __construct(private SluggerInterface $slugger)
    {

    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->displayIf(function (?Post $post) {
                return $this->isGranted('ROLE_POST_REMOVE');
            });
        });

        return $actions;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        return $this->container->get(EntityRepository::class)
            ->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->andWhere('entity.archived = 0')
            ->andWhere('entity.deleted = 0');
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$this->isGranted('ROLE_POST_REMOVE')) {
            return;
        }

        $post = $entityInstance;
        $user = $this->getUser();
        if (!$post instanceof Post) {
            throw new InvalidEntityTypeException();
        }
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $post->setArchived(true);
        $post->setEditedAt(new DateTimeImmutable());
        $post->setEditedBy($user);

        $entityManager->persist($post);
        $entityManager->flush();
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

    public function createEntity(string $entityFqcn): Post
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $post = new Post();
        $post->setCreatedBy($user);
        return $post;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $post = $entityInstance;
        if (!$post instanceof Post) {
            throw new InvalidEntityTypeException();
        }

        $post->setSlug($this->slugger->slug($post->getSlug())->toString());
        $post->setEditedAt(new DateTimeImmutable());

        parent::updateEntity($entityManager, $post);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $post = $entityInstance;
        if (!$post instanceof Post) {
            throw new InvalidEntityTypeException();
        }

        if (!isset($post->slug)) {
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
            BooleanField::new('published'),
            TextField::new('title'),
            TextField::new('slug')
                ->hideWhenCreating(),
            CKEditorField::new('html')->setTemplatePath('components/easy_admin_text_editor.html.twig')
        ];
    }
}
