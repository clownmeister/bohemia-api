<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\PostRepository")
 */
#[UniqueEntity(fields: ['slug'], message: 'Duplicate slug, please change title.')]
class Post
{
    /**
     * @ORM\Column(type="string", length=64)
     */
    public string $slug;
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
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private string $html;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeImmutable $createdAt;
    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $editedAt = null;
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

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="postCollection")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private User $editedBy;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
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
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getEditedAt(): ?DateTimeImmutable
    {
        return $this->editedAt;
    }

    /**
     * @param DateTimeImmutable|null $editedAt
     */
    public function setEditedAt(?DateTimeImmutable $editedAt): void
    {
        $this->editedAt = $editedAt;
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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }
}
