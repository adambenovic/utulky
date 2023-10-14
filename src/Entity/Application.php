<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\FormRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: FormRepository::class)]
class Application
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'forms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $adopter = null;

    #[ORM\ManyToOne(inversedBy: 'forms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pet $pet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdopter(): ?User
    {
        return $this->adopter;
    }

    public function setAdopter(?User $adopter): static
    {
        $this->adopter = $adopter;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(?Pet $pet): static
    {
        $this->pet = $pet;

        return $this;
    }
}
