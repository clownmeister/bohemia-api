<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use ClownMeister\BohemiaApi\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
final class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private string $title;
    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private string $text;
    /**
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\OneToMany(targetEntity="ClownMeister\BohemiaApi\Entity\User",mappedBy="id")
     */
    private string $author_id;
    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeImmutable $created_at;
    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private DateTimeImmutable $edited_at;
    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private bool $archived = false;
    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private bool $deleted = false;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getAuthorId(): string
    {
        return $this->author_id;
    }

    /**
     * @param string $author_id
     */
    public function setAuthorId(string $author_id): void
    {
        $this->author_id = $author_id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEditedAt(): DateTimeImmutable
    {
        return $this->edited_at;
    }

    /**
     * @param DateTimeImmutable $edited_at
     */
    public function setEditedAt(DateTimeImmutable $edited_at): void
    {
        $this->edited_at = $edited_at;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived): void
    {
        $this->archived = $archived;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

}
