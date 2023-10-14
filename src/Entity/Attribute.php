<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: AttributeRepository::class)]
class Attribute
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
     * @var array<string>|null $choices
     */
    private ?array $choices = null;

    #[ORM\ManyToMany(targetEntity: Template::class, mappedBy: 'attributes')]
    private Collection $templates;

    #[ORM\Column]
    private ?bool $required = null;

    public function __construct()
    {
        $this->templates = new ArrayCollection();
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

    /**
     * @return Collection<int, Template>
     */
    public function getTemplates(): Collection
    {
        return $this->templates;
    }

    public function addTemplate(Template $template): static
    {
        if (!$this->templates->contains($template)) {
            $this->templates->add($template);
            $template->addAttribute($this);
        }

        return $this;
    }

    public function removeTemplate(Template $template): static
    {
        if ($this->templates->removeElement($template)) {
            $template->removeAttribute($this);
        }

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
