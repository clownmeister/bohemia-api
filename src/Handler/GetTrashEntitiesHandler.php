<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Handler;

use ClownMeister\BohemiaApi\Entity\TrashEntity;
use ClownMeister\BohemiaApi\Factory\TrashEntityFactory;
use ClownMeister\BohemiaApi\Repository\CommentRepository;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class GetTrashEntitiesHandler
{
    public function __construct(
        private TrashEntityFactory $factory,
        private PostRepository $postRepository,
        private CommentRepository $commentRepository,
        private AuthorizationCheckerInterface $authorization
    ) {
    }

    /**
     * @return TrashEntity[]
     */
    public function handle(): array
    {
        $result = [];

        if ($this->authorization->isGranted('ROLE_POST_REMOVE')) {
            $result = array_merge(
                $result,
                $this->factory->createFromArray(
                    $this->postRepository->findBy(['archived' => 1])
                )
            );
        }

        if ($this->authorization->isGranted('ROLE_POST_RESTORE')) {
            $result = array_merge(
                $result,
                $this->factory->createFromArray(
                    $this->postRepository->findBy(['deleted' => 1])
                )
            );
        }

        if ($this->authorization->isGranted('ROLE_COMMENT_REMOVE')) {
            $result = array_merge(
                $result,
                $this->factory->createFromArray(
                    $this->commentRepository->findBy(['archived' => 1])
                )
            );
        }

        if ($this->authorization->isGranted('ROLE_COMMENT_RESTORE')) {
            $result = array_merge(
                $result,
                $this->factory->createFromArray(
                    $this->commentRepository->findBy(['deleted' => 1])
                )
            );
        }

        return $result;
    }
}
