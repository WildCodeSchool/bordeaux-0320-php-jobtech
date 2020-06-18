<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use App\Service\DateProcessing;
use DateInterval;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $availablePlace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

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
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * Interval between posted date and now.
     */
    private DateInterval $interval;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity=JobCategory::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobCategory;

    /**
     * @ORM\ManyToOne(targetEntity=WorkTime::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workTime;

    /**
     * @ORM\ManyToMany(targetEntity=Contract::class, inversedBy="offers")
     * @ORM\JoinTable(name="offer_has_contracts")
     */
    private $contracts;

    /**
     * @ORM\OneToMany(targetEntity=Apply::class, mappedBy="offer", orphanRemoval=true)
     */
    private $applies;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
        $this->applies = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle();
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAvailablePlace(): ?int
    {
        return $this->availablePlace;
    }

    /**
     * @param int $availablePlace
     * @return $this
     */
    public function setAvailablePlace(int $availablePlace): self
    {
        $this->availablePlace = $availablePlace;

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
     * @return DateTime
     */
    public function getPostedAt(): DateTime
    {
        return $this->postedAt;
    }

    /**
     * @ORM\PrePersist()
     * @return $this
     */
    public function setPostedAt(): self
    {
        $this->postedAt = new DateTime();

        return $this;
    }

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval
    {
        return $this->interval;
    }

    /**
     * @return Offer
     */
    public function setInterval(): self
    {
        $this->interval = DateProcessing::dateIntervalBetweenNowAnd($this->getPostedAt());

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate()
     * @return $this
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new DateTime();

        return $this;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     * @return $this
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Job|null
     */
    public function getJob(): ?Job
    {
        return $this->job;
    }

    /**
     * @param Job|null $job
     * @return $this
     */
    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return JobCategory|null
     */
    public function getJobCategory(): ?JobCategory
    {
        return $this->jobCategory;
    }

    /**
     * @param JobCategory|null $jobCategory
     * @return $this
     */
    public function setJobCategory(?JobCategory $jobCategory): self
    {
        $this->jobCategory = $jobCategory;

        return $this;
    }

    /**
     * @return WorkTime|null
     */
    public function getWorkTime(): ?WorkTime
    {
        return $this->workTime;
    }

    /**
     * @param WorkTime|null $workTime
     * @return $this
     */
    public function setWorkTime(?WorkTime $workTime): self
    {
        $this->workTime = $workTime;

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    /**
     * @param Contract $contract
     * @return $this
     */
    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
        }

        return $this;
    }

    /**
     * @param Contract $contract
     * @return $this
     */
    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->contains($contract)) {
            $this->contracts->removeElement($contract);
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
            $apply->setOffer($this);
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
            if ($apply->getOffer() === $this) {
                $apply->setOffer(null);
            }
        }

        return $this;
    }
}
