<?php

namespace App\Entity;

use App\Repository\MobilityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MobilityRepository::class)
 */
class Mobility
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
    private $isInternational;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $isNational;

    /**
     * @ORM\ManyToOne(targetEntity=Radius::class)
     */
    private $radius;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsInternational(): ?bool
    {
        return $this->isInternational;
    }

    public function setIsInternational(?bool $isInternational): self
    {
        $this->isInternational = $isInternational;

        return $this;
    }

    public function getIsNational(): ?bool
    {
        return $this->isNational;
    }

    public function setIsNational(?bool $isNational): self
    {
        $this->isNational = $isNational;

        return $this;
    }

    public function getRadius(): ?Radius
    {
        return $this->radius;
    }

    public function setRadius(?Radius $radius): self
    {
        $this->radius = $radius;

        return $this;
    }
}
