<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\RoleHierarchyRepository")
 */
final class RoleHierarchy
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Role $parentRole;

    /**
     * @var Collection<int, Role>
     * @ORM\ManyToMany(targetEntity=Role::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Collection $roleCollection;

    public function __construct()
    {
        $this->roleCollection = new ArrayCollection();
    }

    public function getParentRole(): ?Role
    {
        return $this->parentRole;
    }

    public function setParentRole(?Role $parentRole): self
    {
        $this->parentRole = $parentRole;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoleCollection(): Collection
    {
        return $this->roleCollection;
    }

    /**
     * @param ArrayCollection<int, Role> $roleCollection
     *
     */
    public function setRoleCollection(Collection $roleCollection): void
    {
        $this->roleCollection = $roleCollection;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roleCollection->contains($role)) {
            $this->roleCollection[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->roleCollection->removeElement($role);

        return $this;
    }
}
