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
     * @ORM\ManyToOne(targetEntity=Job::class)
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity=Contract::class)
     */
    private $contract;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isPoleEmploi;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isInterim;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isUnemployed;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Contract|null
     */
    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    /**
     * @param Contract|null $contract
     * @return $this
     */
    public function setContract(?Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPoleEmploi(): ?bool
    {
        return $this->isPoleEmploi;
    }

    /**
     * @param bool $isPoleEmploi
     * @return $this
     */
    public function setIsPoleEmploi(bool $isPoleEmploi): self
    {
        $this->isPoleEmploi = $isPoleEmploi;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsInterim(): ?bool
    {
        return $this->isInterim;
    }

    /**
     * @param bool $isInterim
     * @return $this
     */
    public function setIsInterim(bool $isInterim): self
    {
        $this->isInterim = $isInterim;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsUnemployed(): ?bool
    {
        return $this->isUnemployed;
    }

    /**
     * @param bool $isUnemployed
     * @return $this
     */
    public function setIsUnemployed(bool $isUnemployed): self
    {
        $this->isUnemployed = $isUnemployed;

        return $this;
    }
}
