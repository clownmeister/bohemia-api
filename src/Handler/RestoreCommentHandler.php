<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Handler;

use ClownMeister\BohemiaApi\Entity\Comment;
use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Exception\SecurityException;
use ClownMeister\BohemiaApi\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class RestoreCommentHandler
{
    public function __construct(
        private CommentRepository $repository,
        private EntityManagerInterface $entityManager,
        private AuthorizationCheckerInterface $authorization
    ) {
    }

    public function handle(string $id, UserInterface $user): void
    {
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        if (!$this->authorization->isGranted('ROLE_COMMENT_RESTORE')) {
            throw new SecurityException();
        }

        $comment = $this->repository->find($id);
        if (!$comment instanceof Comment) {
            throw new SecurityException();
        }

        $comment->setDeleted(false);
        $comment->setArchived(false);
        $comment->setEditedBy($user);
        $comment->setEditedAt(new DateTimeImmutable());

        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }
}
