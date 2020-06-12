<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
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
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\ManyToMany(targetEntity=JobCategory::class, inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinTable(name="job_have_category")
     */
    private $jobCategory;

    public function __construct()
    {
        $this->jobCategory = new ArrayCollection();
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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

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

    public function addJobCategory(JobCategory $jobCategory): self
    {
        if (!$this->jobCategory->contains($jobCategory)) {
            $this->jobCategory[] = $jobCategory;
        }

        return $this;
    }

    public function removeJobCategory(JobCategory $jobCategory): self
    {
        if ($this->jobCategory->contains($jobCategory)) {
            $this->jobCategory->removeElement($jobCategory);
        }

        return $this;
    }
}
