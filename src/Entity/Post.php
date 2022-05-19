<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use ClownMeister\BohemiaApi\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
#[UniqueEntity(fields: ['slug'], message: 'Duplicate slug, please change title.')]
final class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=64)
     */
    public string $slug;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private string $html;

    /**
     * @ORM\Column(type="ulid")
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
    private bool $published = false;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
