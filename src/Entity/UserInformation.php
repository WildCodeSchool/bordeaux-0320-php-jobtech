<?php

namespace App\Entity;

use App\Repository\UserInformationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserInformationRepository::class)
 */
class UserInformation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=45, maxMessage="Le prénom ne doit pas dépasser 45 caractères")
     * @ORM\Column(type="string", length=45)
     */
    private $lastname;

    /**
     *  @Assert\NotBlank()
     * @Assert\Length(max=45, maxMessage="Le Nom ne doit pas dépasser 45 caractères")
     * @ORM\Column(type="string", length=45)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $homeNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $country;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isHandicapped;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isContactableTel;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isContactableEmail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $haveVehicle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $curriculumVitae;

    /**
     * @ORM\ManyToMany(targetEntity=License::class)
     * @ORM\JoinTable(name="user_have_license")
     */
    private $license;

    /**
     * @ORM\OneToOne(targetEntity=Mobility::class, cascade={"persist", "remove"})
     */
    private $mobility;

    /**
     * @ORM\OneToMany(targetEntity=UserQualification::class, mappedBy="userInformation", orphanRemoval=true)
     */
    private $userQualifications;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class)
     * @ORM\JoinTable(name="user_have_skill")
     */
    private $skill;

    /**
     * @ORM\OneToOne(targetEntity=CurrentSituation::class, cascade={"persist", "remove"})
     */
    private $currentSituation;

    public function __construct()
    {
        $this->license = new ArrayCollection();
        $this->userQualifications = new ArrayCollection();
        $this->skill = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getLastname() . ' ' . $this->getFirstname();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getHomeNumber(): ?int
    {
        return $this->homeNumber;
    }

    public function setHomeNumber(?int $homeNumber): self
    {
        $this->homeNumber = $homeNumber;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getIsHandicapped(): ?bool
    {
        return $this->isHandicapped;
    }

    public function setIsHandicapped(?bool $isHandicapped): self
    {
        $this->isHandicapped = $isHandicapped;

        return $this;
    }

    public function getIsContactableTel(): ?bool
    {
        return $this->isContactableTel;
    }

    public function setIsContactableTel(?bool $isContactableTel): self
    {
        $this->isContactableTel = $isContactableTel;

        return $this;
    }

    public function getIsContactableEmail(): ?bool
    {
        return $this->isContactableEmail;
    }

    public function setIsContactableEmail(?bool $isContactableEmail): self
    {
        $this->isContactableEmail = $isContactableEmail;

        return $this;
    }

    public function getHaveVehicle(): ?bool
    {
        return $this->haveVehicle;
    }

    public function setHaveVehicle(?bool $haveVehicle): self
    {
        $this->haveVehicle = $haveVehicle;

        return $this;
    }

    public function getCurriculumVitae(): ?string
    {
        return $this->curriculumVitae;
    }

    public function setCurriculumVitae(?string $curriculumVitae): self
    {
        $this->curriculumVitae = $curriculumVitae;

        return $this;
    }

    /**
     * @return Collection|License[]
     */
    public function getLicense(): Collection
    {
        return $this->license;
    }

    public function addLicense(License $license): self
    {
        if (!$this->license->contains($license)) {
            $this->license[] = $license;
        }

        return $this;
    }

    public function removeLicense(License $license): self
    {
        if ($this->license->contains($license)) {
            $this->license->removeElement($license);
        }

        return $this;
    }

    public function getMobility(): ?Mobility
    {
        return $this->mobility;
    }

    public function setMobility(?Mobility $mobility): self
    {
        $this->mobility = $mobility;

        return $this;
    }

    /**
     * @return Collection|UserQualification[]
     */
    public function getUserQualifications(): Collection
    {
        return $this->userQualifications;
    }

    public function addUserQualification(UserQualification $userQualification): self
    {
        if (!$this->userQualifications->contains($userQualification)) {
            $this->userQualifications[] = $userQualification;
            $userQualification->setUserInformation($this);
        }

        return $this;
    }

    public function removeUserQualification(UserQualification $userQualification): self
    {
        if ($this->userQualifications->contains($userQualification)) {
            $this->userQualifications->removeElement($userQualification);
            // set the owning side to null (unless already changed)
            if ($userQualification->getUserInformation() === $this) {
                $userQualification->setUserInformation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skill->contains($skill)) {
            $this->skill->removeElement($skill);
        }

        return $this;
    }

    public function getCurrentSituation(): ?CurrentSituation
    {
        return $this->currentSituation;
    }

    public function setCurrentSituation(?CurrentSituation $currentSituation): self
    {
        $this->currentSituation = $currentSituation;

        return $this;
    }
}
