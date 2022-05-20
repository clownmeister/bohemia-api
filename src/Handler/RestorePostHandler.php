<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Handler;

use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Exception\SecurityException;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class RestorePostHandler
{

    public function __construct(
        private PostRepository $repository,
        private EntityManagerInterface $entityManager,
        private AuthorizationCheckerInterface $authorization
    ) {
    }

    public function handle(string $id, UserInterface $user): void
    {
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        if (!$this->authorization->isGranted('ROLE_POST_RESTORE')) {
            throw new SecurityException();
        }

        $post = $this->repository->find($id);
        if (!$post instanceof Post) {
            throw new SecurityException();
        }

        $post->setDeleted(false);
        $post->setArchived(false);
        $post->setEditedBy($user);
        $post->setEditedAt(new DateTimeImmutable());

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}
