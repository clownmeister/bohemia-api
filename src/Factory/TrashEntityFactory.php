<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Factory;

use ClownMeister\BohemiaApi\Entity\Comment;
use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\TrashEntity;
use ClownMeister\BohemiaApi\Exception\InvalidEntityTypeSuppliedFactoryException;

final class TrashEntityFactory implements FactoryInterface
{
    /**
     * @param mixed[] $data
     *
     * @return TrashEntity[]
     */
    public function createFromArray(array $data): array
    {
        $result = [];
        foreach ($data as $entity) {
            $result[] = $this->create($entity);
        }

        return $result;
    }

    public function create(mixed $data): TrashEntity
    {
        return match (get_class($data)) {
            Post::class => new TrashEntity(
                $data->getId(),
                $data->getSlug(),
                TrashEntity::POST_TYPE,
                $data->getEditedAt(),
                $data->isDeleted()
            ),
            Comment::class => new TrashEntity(
                $data->getId(),
                $data->getTitle(),
                TrashEntity::COMMENT_TYPE,
                $data->getEditedAt(),
                $data->isDeleted()
            ),
            default => throw new InvalidEntityTypeSuppliedFactoryException(),
        };
    }
}
