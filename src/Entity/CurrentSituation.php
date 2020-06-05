<?php

namespace App\Entity;

use App\Repository\CurrentSituationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrentSituationRepository::class)
 */
class CurrentSituation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isPoleEmploi;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isInterim;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isUnemployed;

    /**
     * @ORM\ManyToOne(targetEntity=Contract::class)
     */
    private $contract;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class)
     */
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsPoleEmploi(): ?bool
    {
        return $this->isPoleEmploi;
    }

    public function setIsPoleEmploi(bool $isPoleEmploi): self
    {
        $this->isPoleEmploi = $isPoleEmploi;

        return $this;
    }

    public function getIsInterim(): ?bool
    {
        return $this->isInterim;
    }

    public function setIsInterim(bool $isInterim): self
    {
        $this->isInterim = $isInterim;

        return $this;
    }

    public function getIsUnemployed(): ?bool
    {
        return $this->isUnemployed;
    }

    public function setIsUnemployed(bool $isUnemployed): self
    {
        $this->isUnemployed = $isUnemployed;

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
}
