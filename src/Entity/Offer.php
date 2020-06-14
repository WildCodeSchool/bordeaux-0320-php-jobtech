<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use App\Service\DateProcessing;
use DateTime;
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
     * @ORM\Column(type="string", length=45)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

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
    private $createdAt;

    private $interval;

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
     * @ORM\ManyToOne(targetEntity=Contract::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $contract;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="offer")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Apply::class, mappedBy="offer")
     */
    private $applies;

    /**
     * @ORM\ManyToOne(targetEntity=DurationWorkTime::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=JobCategory::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobCategory;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->applies = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     * @return $this
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTime();

        return $this;
    }

    public function getInterval(): \DateInterval
    {
        return $this->interval;
    }

    public function setInterval(): self
    {
        $this->interval = DateProcessing::dateIntervalBetweenNowAnd($this->getCreatedAt());

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(?Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addOffer($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeOffer($this);
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

    public function addApply(Apply $apply): self
    {
        if (!$this->applies->contains($apply)) {
            $this->applies[] = $apply;
            $apply->setOffer($this);
        }

        return $this;
    }

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

    public function getDuration(): ?DurationWorkTime
    {
        return $this->duration;
    }

    public function setDuration(?DurationWorkTime $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getJobCategory(): ?JobCategory
    {
        return $this->jobCategory;
    }

    public function setJobCategory(?JobCategory $jobCategory): self
    {
        $this->jobCategory = $jobCategory;

        return $this;
    }
}
