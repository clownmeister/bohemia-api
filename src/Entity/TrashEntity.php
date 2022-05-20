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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRemovedAt(): DateTimeImmutable
    {
        return $this->removedAt;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }
}
