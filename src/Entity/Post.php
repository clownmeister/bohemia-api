<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\PostRepository")
 */
#[UniqueEntity(fields: ['slug'], message: 'Duplicate slug, please change title.')]
class Post
{
    //TODO: autowire host
    private const IMAGE_BASE_URL = 'http://api.bohemia.docker/uploads/cover/';

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

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $imageUrl;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     * @Groups("post")
     */
    private ?string $description;

    /**
     * @var ArrayCollection<int, PostCategory>
     * @ORM\ManyToMany(targetEntity=PostCategory::class, mappedBy="postCollection")
     * @Groups("post_category")
     */
    private Collection $categoryCollection;

    /**
     * @var ArrayCollection<int, Comment>
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="postId", orphanRemoval=true)
     */
    private Collection $commentCollection;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->categoryCollection = new ArrayCollection();
        $this->commentCollection = new ArrayCollection();
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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @Groups("post")
     * @return string|null
     */
    public function getImageAbsoluteUrl(): ?string
    {
        return self::IMAGE_BASE_URL . $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PostCategory>
     */
    public function getCategoryCollection(): Collection
    {
        return $this->categoryCollection;
    }

    public function addCategoryCollection(PostCategory $categoryCollection): self
    {
        if (!$this->categoryCollection->contains($categoryCollection)) {
            $this->categoryCollection[] = $categoryCollection;
            $categoryCollection->addPostCollection($this);
        }

        return $this;
    }

    public function removeCategoryCollection(PostCategory $categoryCollection): self
    {
        if ($this->categoryCollection->removeElement($categoryCollection)) {
            $categoryCollection->removePostCollection($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getCommentCollection(): Collection
    {
        return $this->commentCollection;
    }

    public function addCommentCollection(Comment $commentCollection): self
    {
        if (!$this->commentCollection->contains($commentCollection)) {
            $this->commentCollection[] = $commentCollection;
            $commentCollection->setPostId($this);
        }

        return $this;
    }

    public function removeCommentCollection(Comment $commentCollection): self
    {
        if ($this->commentCollection->removeElement($commentCollection)) {
            // set the owning side to null (unless already changed)
            if ($commentCollection->getPostId() === $this) {
                $commentCollection->setPostId(null);
            }
        }

        return $this;
    }
}
