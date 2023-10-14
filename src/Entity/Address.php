<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $streetNumber = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Application::class)]
    private Collection $forms;

    #[ORM\ManyToOne(inversedBy: 'address')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $person = null;

    #[ORM\Column]
    private ?bool $isMain = null;

    public function __construct()
    {
        $this->forms = new ArrayCollection();
        $this->isMain = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): static
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getForms(): Collection
    {
        return $this->forms;
    }

    public function addForm(Application $form): static
    {
        if (!$this->forms->contains($form)) {
            $this->forms->add($form);
            $form->setAddress($this);
        }

        return $this;
    }

    public function removeForm(Application $form): static
    {
        // set the owning side to null (unless already changed)
        if ($this->forms->removeElement($form) && $form->getAddress() === $this) {
            $form->setAddress(null);
        }

        return $this;
    }

    public function getPerson(): ?User
    {
        return $this->person;
    }

    public function setPerson(?User $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): static
    {
        $this->isMain = $isMain;

        return $this;
    }
}
