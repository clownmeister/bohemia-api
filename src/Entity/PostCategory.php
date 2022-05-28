<?php

namespace ClownMeister\BohemiaApi\Entity;

use ClownMeister\BohemiaApi\Repository\PostCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PostCategoryRepository::class)
 */
class PostCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post_category")
     */
    private string $name;

    /**
     * @var ArrayCollection<int, Post>
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="categoryCollection")
     */
    private Collection $postCollection;

    public function __construct()
    {
        $this->postCollection = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPostCollection(): Collection
    {
        return $this->postCollection;
    }

    public function addPostCollection(Post $postCollection): self
    {
        if (!$this->postCollection->contains($postCollection)) {
            $this->postCollection[] = $postCollection;
        }

        return $this;
    }

    public function removePostCollection(Post $postCollection): self
    {
        $this->postCollection->removeElement($postCollection);

        return $this;
    }
}
