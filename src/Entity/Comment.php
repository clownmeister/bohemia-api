<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\CommentRepository")
 */
class Comment
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
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
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
