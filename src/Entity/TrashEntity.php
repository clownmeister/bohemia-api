<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;

final class TrashEntity
{
    public const POST_TYPE = 'post';
    public const COMMENT_TYPE = 'comment';

    public function __construct(
        private string $id,
        private string $name,
        private string $type,
        private DateTimeImmutable $removedAt,
        private bool $deleted
    ) {
    }

    /**
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     */
    public function getRemovedAt(): DateTimeImmutable
    {
        return $this->removedAt;
    }

    /**
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }
}
