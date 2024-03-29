<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Secured resource.
 */
#[ApiResource(security: "is_granted('ROLE_USER')")]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy:"createdItems")]
    #[Assert\NotNull]
    private User $creator;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy:"validatedItems")]
    private User $validator;

    /**
     * @var Collection|Tag[]
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: "items")]
    #[ORM\JoinTable(name:"items_tags")]
    private $tags;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThan(value: 'now', message:"Publication date must be greater than the current date.")]
    private ?\DateTimeInterface $publication_date = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 20)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $validation_date = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $isValidated = false;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $isArchived = false;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(?\DateTimeInterface $publication_date): static
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getCreator(): User
    {
        return $this->creator;
    }

    public function setCreator(User $user): static
    {
        $this->creator = $user;
        return $this;
    }

    public function getValidator(): User
    {
        return $this->validator;
    }

    public function setValidator(User $user): static
    {
        $this->validator = $user;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addItem($this);
        }
    }

    public function removeTag(Tag $tag)
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeItem($this);
        }
    }



    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validation_date;
    }

    public function setValidationDate(?\DateTimeInterface $validation_date): static
    {
        $this->validation_date = $validation_date;

        return $this;
    }

    public function getIsValidated(): ?bool
    {
        return $this->isValidated;
    }

    public function setIsValidated(bool $isValidated): static
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): static
    {
        $this->isArchived = $isArchived;

        return $this;
    }
}
