<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="le champ prénom ne doit pas être vide !")
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(max=45, maxMessage="Le prénom ne doit pas dépasser 45 caractères")
     */
    private $surname;

    /**
     * @Assert\NotBlank((message="le champ prénom ne doit pas être vide !"))
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(max=45, maxMessage="Le Nom ne doit pas dépasser 45 caractères")
     */
    private $firstName;

    /**
     * @Assert\NotBlank((message="le champ Email ne doit pas être vide !"))
     * @ORM\Column(type="string", length=80)
     * @Assert\Length(max=80, maxMessage="Le Nom ne doit pas dépasser 80 caractères")
     */
    private $email;

    /**
     * @Assert\NotBlank((message="le champ Poste ne doit pas être vide !"))
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100, maxMessage="Le Nom ne doit pas dépasser 100 caractères")
     */
    private $job;

    /**
     * @Assert\NotBlank((message="le champ Numéro de téléphone ne doit pas être vide !"))
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max=20, maxMessage="Le Numéro de téléphone ne doit pas dépasser 20 caractères")
     */
    private $phone_number;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    public function __toString()
    {
        return $this->getSurname() . ' ' . $this->getFirstName();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return $this
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return $this
     */
    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    /**
     * @param string|null $phone_number
     * @return $this
     */
    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * @return Gender|null
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender|null $gender
     * @return $this
     */
    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
