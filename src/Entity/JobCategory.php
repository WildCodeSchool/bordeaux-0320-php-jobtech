<?php

namespace App\Entity;

use App\Repository\JobCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobCategoryRepository::class)
 */
class JobCategory
{
    const AERONAUTICS = [
        'title' => 'Aéronautique',
        'icon' => 'fas fa-plane',
        'identifier' => 'aeronautics'
    ];
    const MECHANIC = [
        'title' => 'Mécanique',
        'icon' => 'fas fa-wrench',
        'identifier' => 'mechanic'
    ];
    const CONCRETE_STRUCTURE = [
        'title' => 'Structure béton',
        'icon' => 'fas fa-archway',
        'identifier' => 'concrete_structure'
    ];
    const WOOD_STRUCTURE = [
        'title' => 'Structure bois',
        'icon' => 'fas fa-tree',
        'identifier' => 'wood_structure'
    ];
    const STEEL_FRAME = [
        'title' => 'Charpente métallique',
        'icon' => 'fas fa-building',
        'identifier' => 'steel_frame'
    ];
    const CLIMATE_ENGINEER = [
        'title' => 'Génie climatique',
        'icon' => 'fas fa-temperature-low',
        'identifier' => 'climate_engineer'
    ];
    const ELECTRICAL_ENGINEER = [
        'title' => 'Génie électrique',
        'icon' => 'fas fa-charging-station',
        'identifier' => 'electrical_engineer'
    ];
    const SHEET_METAL = [
        'title' => 'Tôlerie',
        'icon' => 'fab fa-accusoft',
        'identifier' => 'sheet_metal'
    ];
    const ECOLOGICAL_ENVIRONMENT = [
        'title' => 'Environnement Écologie',
        'icon' => 'fab fa-envira',
        'identifier' => 'ecological_environment'
    ];
    const SYSTEM = [
        'title' => 'Système',
        'icon' => 'fas fa-lightbulb',
        'identifier' => 'system'
    ];
    const CONSTRUCTION = [
        'title' => 'Bâtiment',
        'icon' => 'fas fa-hard-hat',
        'identifier' => 'construction'
    ];
    const RMN = [
        'title' => 'VRD',
        'icon' => 'fas fa-route',
        'identifier' => 'rmn'
    ]; // Roads and Miscellaneous Networks
    const OPTIC = [
        'title' => 'Optique',
        'icon' => 'fas fa-eye',
        'identifier' => 'optic'
    ];
    const DIGITAL = [
        'title' => 'Digital',
        'icon' => 'fas fa-atlas',
        'identifier' => 'digital'
    ];
    const MARKETING = [
        'title' => 'Marketing',
        'icon' => 'fas fa-comments-dollar',
        'identifier' => 'marketing'
    ];

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
     * @ORM\Column(type="string", length=45)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, mappedBy="jobCategory")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="jobCategory", orphanRemoval=true)
     */
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity=Search::class, mappedBy="jobCategory", orphanRemoval=true)
     */
    private $searches;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->searches = new ArrayCollection();
    }

    public function __toString()
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
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string|null $identifier
     * @return $this
     */
    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->addJobCategory($this);
        }

        return $this;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
            $job->removeJobCategory($this);
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
            $offer->setJobCategory($this);
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
            if ($offer->getJobCategory() === $this) {
                $offer->setJobCategory(null);
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
            $search->setJobCategory($this);
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
            if ($search->getJobCategory() === $this) {
                $search->setJobCategory(null);
            }
        }

        return $this;
    }
}
