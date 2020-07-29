<?php

namespace App\Entity;

use App\Repository\Api\RestCountries;
use App\Repository\CandidateRepository;
use App\Service\ArrayManager;
use App\Service\DateManager;
use App\Service\NumberManager;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
     * @Assert\Length(max=45, maxMessage="Le prénom ne doit pas dépasser {{ limit }} caractères")
     */
    private $surname;

    /**
     * @Assert\NotBlank(message="le champ prénom ne doit pas être vide !")
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(max=45, maxMessage="Le Nom ne doit pas dépasser {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @Assert\NotBlank(message="Veuillez choisir une date d'anniversaire !")
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @Assert\NotBlank(message="le champ Numéro de téléphone ne doit pas être vide !")
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max=20, maxMessage="Le Numéro de téléphone ne doit pas dépasser {{ limit }} caractères")
     */
    private $phoneNumber;

    /**
     * @Assert\NotBlank(message="le champ autre numéro ne doit pas être vide !")
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20, maxMessage="Le Numéro de téléphone ne doit pas dépasser {{ limit }} caractères")
     */
    private $otherNumber;

    /**
     * @Assert\NotBlank(message="le champ Code postal ne doit pas être vide !")
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *     min=3, minMessage="Le Code postal ne doit pas faire moins de {{ limit }} chiffres",
     *     max=7, maxMessage="Le Code postal ne doit pas dépasser {{ limit }} caractères"
     * )
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
     * @ORM\OneToOne(targetEntity=Search::class, mappedBy="candidate", orphanRemoval=true)
     */
    private $search;

    /**
     * @ORM\ManyToMany(targetEntity=License::class)
     * @ORM\JoinTable(name="candidate_has_licenses")
     */
    private $licenses;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="candidate", orphanRemoval=true)
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=Questionnaire::class, mappedBy="candidate")
     */
    private $questionnaires;

    /**
     * @ORM\OneToOne(targetEntity=CurriculumVitae::class, inversedBy="candidate", cascade={"persist", "remove"})
     */
    private $curriculumVitae;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="candidate", orphanRemoval=true)
     */
    private $experiences;

    /**
     * Candidate constructor.
     */
    public function __construct()
    {
        $this->bookmarks = new ArrayCollection();
        $this->applies = new ArrayCollection();
        $this->licenses = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->questionnaires = new ArrayCollection();
        $this->experiences = new ArrayCollection();
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
     * @return string
     */
    public function getFullNameWithGender(): string
    {
        return $this->getGender()->getAcronym() . ' ' . $this->getSurname() . ' ' . $this->getFirstName();
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
     * @return DateTime
     */
    public function getBirthday(): ?DateTime
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
     * @return int
     */
    public function getAge(): int
    {
        return DateManager::calculateAge($this->getBirthday());
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getFormattedPhoneNumber(): ?string
    {
        return NumberManager::addPointToPhoneNumber($this->getPhoneNumber());
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

    public function getFormattedOtherPhoneNumber(): ?string
    {
        return NumberManager::addPointToPhoneNumber($this->getOtherNumber());
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
     * @return string|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCountryFullName(): ?string
    {
        $restCountries = new RestCountries();
        return $restCountries->getCountryByCode($this->country);
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

    /**
     * @return Collection|Questionnaire[]
     */
    public function getQuestionnaires(): Collection
    {
        return $this->questionnaires;
    }

    public function addQuestionnaire(Questionnaire $questionnaire): self
    {
        if (!$this->questionnaires->contains($questionnaire)) {
            $this->questionnaires[] = $questionnaire;
            $questionnaire->setCandidate($this);
        }

        return $this;
    }

    public function removeQuestionnaire(Questionnaire $questionnaire): self
    {
        if ($this->questionnaires->contains($questionnaire)) {
            $this->questionnaires->removeElement($questionnaire);
            // set the owning side to null (unless already changed)
            if ($questionnaire->getCandidate() === $this) {
                $questionnaire->setCandidate(null);
            }
        }

        return $this;
    }

    public function isBookmarked(Offer $offer): bool
    {
        return $this->getBookmarks()->contains($offer);
    }

    public function haveApply(Offer $offer): bool
    {
        return in_array($offer, ArrayManager::getOffersFromApplies($this->getApplies()->toArray()));
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setCandidate($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getCandidate() === $this) {
                $skill->setCandidate(null);
            }
        }

        return $this;
    }

    public function getCurriculumVitae(): ?CurriculumVitae
    {
        return $this->curriculumVitae;
    }

    public function setCurriculumVitae(?CurriculumVitae $curriculumVitae): self
    {
        $this->curriculumVitae = $curriculumVitae;

        return $this;
    }

    public function getSearch(): ?Search
    {
        return $this->search;
    }

    public function setSearch(?Search $search): self
    {
        $this->search = $search;

        // set (or unset) the owning side of the relation if necessary
        $newCandidate = null === $search ? null : $this;
        if ($search->getCandidate() !== $newCandidate) {
            $search->setCandidate($newCandidate);
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setCandidate($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getCandidate() === $this) {
                $experience->setCandidate(null);
            }
        }

        return $this;
    }
}
