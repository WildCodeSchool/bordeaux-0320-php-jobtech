<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="le champ Nom de l'entreprise ne doit pas être vide !")
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100, maxMessage="Le Nom de l'entreprise ne doit pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @Assert\NotBlank(message="le champ Siret ne doit pas être vide !")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255, maxMessage="Le champ Siret ne doit pas dépasser {{ limit }} caractères")
     */
    private $siret;

    /**
     * @Assert\NotBlank(message="le champ Adresse ne doit pas être vide !")
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255, maxMessage="Le champ Adresse ne doit pas dépasser {{ limit }} caractères")
     */
    private $address;

    /**
     * @Assert\NotBlank(message="le champ Code postal ne doit pas être vide !")
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *     min=3, minMessage="Le Code postal ne doit pas faire moins de 3 chiffres",
     *     max=5, maxMessage="Le Code postal ne doit pas dépasser {{ limit )} caractères"
     * )
     */
    private $postal_code;

    /**
     * @Assert\NotBlank(message="le champ Ville ne doit pas être vide !")
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60, maxMessage="Le nom de la ville ne doit pas dépasser {{ limit }} caractères")
     */
    private $city;

    /**
     * @Assert\NotBlank(message="le champ Pays ne doit pas être vide !")
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60, maxMessage="Le nom du pays ne doit pas dépasser {{ limit }} caractères")
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="company", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="company", orphanRemoval=true)
     */
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="company", orphanRemoval=true)
     */
    private $contacts;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSiret(): ?string
    {
        return $this->siret;
    }

    /**
     * @param string|null $siret
     * @return $this
     */
    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    /**
     * @param int $postal_code
     * @return $this
     */
    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newCompany = null === $user ? null : $this;
        if ($user->getCompany() !== $newCompany) {
            $user->setCompany($newCompany);
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setCompany($this);
        }

        return $this;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->contains($offer)) {
            $this->offers->removeElement($offer);
            // set the owning side to null (unless already changed)
            if ($offer->getCompany() === $this) {
                $offer->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCompany($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getCompany() === $this) {
                $contact->setCompany(null);
            }
        }

        return $this;
    }
}
