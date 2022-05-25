<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\PostRepository")
 */
#[UniqueEntity(fields: ['slug'], message: 'Duplicate slug, please change title.')]
class Post
{
    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("post")
     */
    public string $slug;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     * @Groups("post")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("post")
     */
    private string $title;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     * @Groups("post")
     */
    private string $html;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups("post")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups("post")
     */
    private ?DateTimeImmutable $editedAt = null;

    /** @ORM\Column(type="boolean", options={"default": 0}) */
    private bool $published = false;

    /** @ORM\Column(type="boolean", options={"default": 0}) */
    private bool $archived = false;

    /** @ORM\Column(type="boolean", options={"default": 0}) */
    private bool $deleted = false;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post")
     */
    private User $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups("post")
     */
    private User $editedBy;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getEditedAt(): ?DateTimeImmutable
    {
        return $this->editedAt;
    }

    public function setEditedAt(?DateTimeImmutable $editedAt): void
    {
        $this->editedAt = $editedAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function isArchived(): bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): void
    {
        $this->archived = $archived;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(User $editedBy): void
    {
        $this->editedBy = $editedBy;
    }
}
