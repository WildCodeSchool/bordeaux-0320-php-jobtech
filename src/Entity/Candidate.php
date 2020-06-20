<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidateRepository::class)
 */
class Candidate
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
     * @Assert\NotBlank((message="Veuillez choisir une date d'anniversaire !"))
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @Assert\NotBlank((message="le champ Numéro de téléphone ne doit pas être vide !"))
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max=20, maxMessage="Le Numéro de téléphone ne doit pas dépasser 20 caractères")
     */
    private $phoneNumber;

    /**
     * @Assert\NotBlank(message="le champ autre numéro ne doit pas être vide !")
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20, maxMessage="Le Numéro de téléphone ne doit pas dépasser 20 caractères")
     */
    private $otherNumber;

    /**
     * @Assert\NotBlank(message="le champ Code postal ne doit pas être vide !")
     * @ORM\Column(type="integer")
     * @Assert\Length(min="3" max=5, maxMessage="Le Code postal ne doit pas dépasser 20 caractères",
      minMessage="Le Code postal ne doit pas faire moins de 3 chiffres")
     */
    private $postalCode;

    /**
     * @Assert\NotBlank(message="le champ Ville ne doit pas être vide !")
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60, maxMessage="Le nom de la ville ne doit pas dépasser 60 caractères")
     */
    private $city;

    /**
     * @Assert\NotBlank(message="le champ Pays ne doit pas être vide !")
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60, maxMessage="Le nom du pays ne doit pas dépasser 60 caractères")
     */
    private $country;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isHandicapped;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isContactableTel;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isContactableEmail;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $haveVehicle = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $curriculumVitae = 'test';

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="candidate", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Offer::class)
     * @ORM\JoinTable(name="bookmark")
     */
    private $bookmarks;

    /**
     * @ORM\OneToMany(targetEntity=Apply::class, mappedBy="user", orphanRemoval=true)
     */
    private $applies;

    /**
     * @ORM\OneToMany(targetEntity=Search::class, mappedBy="candidate", orphanRemoval=true)
     */
    private $searches;

    /**
     * @ORM\ManyToMany(targetEntity=License::class)
     * @ORM\JoinTable(name="candidate_has_licenses")
     */
    private $licenses;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class)
     * @ORM\JoinTable(name="candidate_has_skills")
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=CandidateHasQualifications::class, mappedBy="candidate", orphanRemoval=true)
     */
    private $qualifications;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * Candidate constructor.
     */
    public function __construct()
    {
        $this->bookmarks = new ArrayCollection();
        $this->applies = new ArrayCollection();
        $this->qualifications = new ArrayCollection();
        $this->searches = new ArrayCollection();
        $this->licenses = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->qualifications = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getFullname();
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
    public function getFullName(): string
    {
        return $this->getSurname() . ' ' . $this->getFirstName();
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
     * @return DateTimeInterface|null
     */
    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @param DateTimeInterface $birthday
     * @return $this
     */
    public function setBirthday(DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOtherNumber(): ?string
    {
        return $this->otherNumber;
    }

    /**
     * @param string|null $otherNumber
     * @return $this
     */
    public function setOtherNumber(?string $otherNumber): self
    {
        $this->otherNumber = $otherNumber;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     * @return $this
     */
    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

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
     * @return bool|null
     */
    public function getIsHandicapped(): ?bool
    {
        return $this->isHandicapped;
    }

    /**
     * @param bool $isHandicapped
     * @return $this
     */
    public function setIsHandicapped(bool $isHandicapped): self
    {
        $this->isHandicapped = $isHandicapped;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsContactableTel(): ?bool
    {
        return $this->isContactableTel;
    }

    /**
     * @param bool $isContactableTel
     * @return $this
     */
    public function setIsContactableTel(bool $isContactableTel): self
    {
        $this->isContactableTel = $isContactableTel;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsContactableEmail(): ?bool
    {
        return $this->isContactableEmail;
    }

    /**
     * @param bool $isContactableEmail
     * @return $this
     */
    public function setIsContactableEmail(bool $isContactableEmail): self
    {
        $this->isContactableEmail = $isContactableEmail;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHaveVehicle(): ?bool
    {
        return $this->haveVehicle;
    }

    /**
     * @param bool $haveVehicle
     * @return $this
     */
    public function setHaveVehicle(bool $haveVehicle): self
    {
        $this->haveVehicle = $haveVehicle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurriculumVitae(): ?string
    {
        return $this->curriculumVitae;
    }

    /**
     * @param string $curriculumVitae
     * @return $this
     */
    public function setCurriculumVitae(string $curriculumVitae): self
    {
        $this->curriculumVitae = $curriculumVitae;

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
        $newCandidate = null === $user ? null : $this;
        if ($user->getCandidate() !== $newCandidate) {
            $user->setCandidate($newCandidate);
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getBookmarks(): Collection
    {
        return $this->bookmarks;
    }

    /**
     * @param Offer $bookmark
     * @return $this
     */
    public function addBookmark(Offer $bookmark): self
    {
        if (!$this->bookmarks->contains($bookmark)) {
            $this->bookmarks[] = $bookmark;
        }

        return $this;
    }

    /**
     * @param Offer $bookmark
     * @return $this
     */
    public function removeBookmark(Offer $bookmark): self
    {
        if ($this->bookmarks->contains($bookmark)) {
            $this->bookmarks->removeElement($bookmark);
        }

        return $this;
    }

    /**
     * @return Collection|Apply[]
     */
    public function getApplies(): Collection
    {
        return $this->applies;
    }

    /**
     * @param Apply $apply
     * @return $this
     */
    public function addApply(Apply $apply): self
    {
        if (!$this->applies->contains($apply)) {
            $this->applies[] = $apply;
            $apply->setUser($this);
        }

        return $this;
    }

    /**
     * @param Apply $apply
     * @return $this
     */
    public function removeApply(Apply $apply): self
    {
        if ($this->applies->contains($apply)) {
            $this->applies->removeElement($apply);
            // set the owning side to null (unless already changed)
            if ($apply->getUser() === $this) {
                $apply->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Search[]
     */
    public function getSearches(): Collection
    {
        return $this->searches;
    }

    /**
     * @param Search $search
     * @return $this
     */
    public function addSearch(Search $search): self
    {
        if (!$this->searches->contains($search)) {
            $this->searches[] = $search;
            $search->setCandidate($this);
        }

        return $this;
    }

    /**
     * @param Search $search
     * @return $this
     */
    public function removeSearch(Search $search): self
    {
        if ($this->searches->contains($search)) {
            $this->searches->removeElement($search);
            // set the owning side to null (unless already changed)
            if ($search->getCandidate() === $this) {
                $search->setCandidate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|License[]
     */
    public function getLicenses(): Collection
    {
        return $this->licenses;
    }

    /**
     * @param License $license
     * @return $this
     */
    public function addLicense(License $license): self
    {
        if (!$this->licenses->contains($license)) {
            $this->licenses[] = $license;
        }

        return $this;
    }

    /**
     * @param License $license
     * @return $this
     */
    public function removeLicense(License $license): self
    {
        if ($this->licenses->contains($license)) {
            $this->licenses->removeElement($license);
        }

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return $this
     */
    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    /**
     * @param Skill $skill
     * @return $this
     */
    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    /**
     * @return Collection|CandidateHasQualifications[]
     */
    public function getQualifications(): Collection
    {
        return $this->qualifications;
    }

    /**
     * @param CandidateHasQualifications $qualification
     * @return $this
     */
    public function addQualification(CandidateHasQualifications $qualification): self
    {
        if (!$this->qualifications->contains($qualification)) {
            $this->qualifications[] = $qualification;
            $qualification->setCandidate($this);
        }

        return $this;
    }

    /**
     * @param CandidateHasQualifications $qualification
     * @return $this
     */
    public function removeQualification(CandidateHasQualifications $qualification): self
    {
        if ($this->qualifications->contains($qualification)) {
            $this->qualifications->removeElement($qualification);
            // set the owning side to null (unless already changedok)
            if ($qualification->getCandidate() === $this) {
                $qualification->setCandidate(null);
            }
        }

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
}
