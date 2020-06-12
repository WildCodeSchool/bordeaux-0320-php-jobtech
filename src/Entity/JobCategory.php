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
        'title' => 'Génie climatique (CVC)',
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
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $icon;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, mappedBy="jobCategory")
     */
    private $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->addJobCategory($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
            $job->removeJobCategory($this);
        }

        return $this;
    }
}
