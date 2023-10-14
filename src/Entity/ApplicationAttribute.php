<?php

namespace App\Entity;

use App\Repository\ApplicationAttributeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ApplicationAttributeRepository::class)]
class ApplicationAttribute
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expectedValue = null;

    #[ORM\Column(nullable: true)]
    /**
     * @var array<string>|null
     */
    private ?array $choices = null;

    #[ORM\Column]
    private ?bool $required = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getExpectedValue(): ?string
    {
        return $this->expectedValue;
    }

    public function setExpectedValue(?string $expectedValue): static
    {
        $this->expectedValue = $expectedValue;

        return $this;
    }

    public function getChoices(): ?array
    {
        return $this->choices;
    }

    public function setChoices(?array $choices): static
    {
        $this->choices = $choices;

        return $this;
    }

    public function isRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): static
    {
        $this->required = $required;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
