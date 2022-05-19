<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="ClownMeister\BohemiaApi\Repository\UserRepository")
 */
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.ulid_generator")
     */
    private string $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $firstname;
    /**
     * @ORM\Column(type="string")
     */
    private string $lastname;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $phone;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $street;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $city;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $state;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $country;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $zip;
    /**
     * @ORM\Column(type="string")
     */
    private string $email;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;
    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private ?bool $isVerified = false;
    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, Post>
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="createdBy")
     */
    private Collection $postCollection;

    /**
     * @var Collection<int, Role>
     * @ORM\ManyToMany(targetEntity=Role::class)
     */
    private Collection $roleCollection;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->postCollection = new ArrayCollection();
        $this->roleCollection = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
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
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     */
    public function setZip(?string $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return bool|null
     */
    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    /**
     * @param bool|null $isVerified
     */
    public function setIsVerified(?bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPostCollection(): Collection
    {
        return $this->postCollection;
    }

    public function addPost(Post $post): self
    {
        if (!$this->postCollection->contains($post)) {
            $this->postCollection[] = $post;
            $post->setCreatedBy($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->postCollection->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCreatedBy() === $this) {
                $post->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @param Collection<int, Role> $roleCollection
     */
    public function setRoleCollection(Collection $roleCollection): void
    {
        $this->roleCollection = $roleCollection;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = [];
        foreach ($this->roleCollection as $role) {
            $roles[] = $role->getName();
        }

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoleCollection(): Collection
    {
        return $this->roleCollection;
    }

    public function addRole(Role $roleCollection): self
    {
        if (!$this->roleCollection->contains($roleCollection)) {
            $this->roleCollection[] = $roleCollection;
        }

        return $this;
    }

    public function removeRole(Role $roleCollection): self
    {
        $this->roleCollection->removeElement($roleCollection);

        return $this;
    }
}
