<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
class Template
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Attribute::class, inversedBy: 'templates')]
    private Collection $attributes;

    #[ORM\ManyToOne(inversedBy: 'templates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToMany(mappedBy: 'template', targetEntity: Pet::class)]
    private Collection $pets;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->pets = new ArrayCollection();
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

    /**
     * @return Collection<int, Attribute>
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute): static
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): static
    {
        $this->attributes->removeElement($attribute);

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Pet>
     */
    public function getPets(): Collection
    {
        return $this->pets;
    }

    public function addPet(Pet $pet): static
    {
        if (!$this->pets->contains($pet)) {
            $this->pets->add($pet);
            $pet->setTemplate($this);
        }

        return $this;
    }

    public function removePet(Pet $pet): static
    {
        // set the owning side to null (unless already changed)
        if ($this->pets->removeElement($pet) && $pet->getTemplate() === $this) {
            $pet->setTemplate(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
