<?php

namespace ClownMeister\BohemiaApi\Entity;

use ClownMeister\BohemiaApi\Repository\RoleHierarchyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleHierarchyRepository::class)
 */
class RoleHierarchy
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;

    /**
     * @ORM\Column(type="ulid")
     * @ORM\OneToMany(targetEntity="ClownMeister\BohemiaApi\Entity\Role",mappedBy="id")
     */
    private string $parentRole;

    /**
     * @var string[]
     * @ORM\Column(type="json")
     * @ORM\ManyToMany(targetEntity="ClownMeister\BohemiaApi\Entity\Role", mappedBy="name")
     */
    private array $includedRoles = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getParentRole(): ?string
    {
        return $this->parentRole;
    }

    public function setParentRole(string $parentRole): self
    {
        $this->parentRole = $parentRole;

        return $this;
    }

    public function getIncludedRoles(): ?array
    {
        return $this->includedRoles;
    }

    public function setIncludedRoles(array $includedRoles): self
    {
        $this->includedRoles = $includedRoles;

        return $this;
    }
}
