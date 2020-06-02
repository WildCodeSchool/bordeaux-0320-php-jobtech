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
     * @ORM\Column(type="boolean")
     */
    private $isPoleEmploi;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isInterim;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isUnemployed;

    /**
     * @ORM\ManyToOne(targetEntity=Contract::class)
     */
    private $contract;

    /**
     * @ORM\ManyToOne(targetEntity=Profession::class)
     */
    private $profession;

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

    public function getProfession(): ?Profession
    {
        return $this->profession;
    }

    public function setProfession(?Profession $profession): self
    {
        $this->profession = $profession;

        return $this;
    }
}
