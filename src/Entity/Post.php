<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use ClownMeister\BohemiaApi\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private Ulid $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $title;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private string $html;

    /**
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\OneToMany(targetEntity="ClownMeister\BohemiaApi\Entity\User",mappedBy="id")
     */
    private UuidV4 $author_id;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeImmutable $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private DateTimeImmutable $edited_at;
    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private bool $published;
    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private bool $archived;
    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private bool $deleted;

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
     * @return Ulid
     */
    public function getId(): Ulid
    {
        return $this->id;
    }

    /**
     * @param Ulid $id
     */
    public function setId(Ulid $id): void
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
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return UuidV4
     */
    public function getAuthorId(): UuidV4
    {
        return $this->author_id;
    }

    /**
     * @param UuidV4 $author_id
     */
    public function setAuthorId(UuidV4 $author_id): void
    {
        $this->author_id = $author_id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeImmutable $created_at
     */
    public function setCreatedAt(DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
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
