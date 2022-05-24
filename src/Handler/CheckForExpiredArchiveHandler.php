<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Handler;

use ClownMeister\BohemiaApi\Repository\CommentRepository;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class CheckForExpiredArchiveHandler
{
    private const ARCHIVE_EXPIRE_SECONDS = 10800;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private PostRepository $postRepository,
        private CommentRepository $commentRepository
    ) {
    }

    public function handle(): void
    {
        $now = new DateTimeImmutable();

        //TODO: common entity interface to avoid repetition
        $posts = $this->postRepository->findBy(['archived' => 1]);
        foreach ($posts as $post) {
            if ($post->getEditedAt()->getTimestamp() + self::ARCHIVE_EXPIRE_SECONDS < $now->getTimestamp()) {
                $post->setArchived(false);
                $post->setDeleted(true);
                $this->entityManager->persist($post);
            }
        }

        $comments = $this->commentRepository->findBy(['archived' => 1]);
        foreach ($comments as $comment) {
            if ($comment->getEditedAt()->getTimestamp() + self::ARCHIVE_EXPIRE_SECONDS < $now->getTimestamp()) {
                $comment->setArchived(false);
                $comment->setDeleted(true);
                $this->entityManager->persist($comment);
            }
        }

        $this->entityManager->flush();
    }
}
