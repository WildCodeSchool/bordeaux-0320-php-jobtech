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
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isInternational;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isNational;

    /**
     * @ORM\ManyToOne(targetEntity=Radius::class)
     */
    private $radius;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getIsInternational(): ?bool
    {
        return $this->isInternational;
    }

    /**
     * @param bool $isInternational
     * @return $this
     */
    public function setIsInternational(bool $isInternational): self
    {
        $this->isInternational = $isInternational;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsNational(): ?bool
    {
        return $this->isNational;
    }

    /**
     * @param bool $isNational
     * @return $this
     */
    public function setIsNational(bool $isNational): self
    {
        $this->isNational = $isNational;

        return $this;
    }

    /**
     * @return Radius|null
     */
    public function getRadius(): ?Radius
    {
        return $this->radius;
    }

    /**
     * @param Radius|null $radius
     * @return $this
     */
    public function setRadius(?Radius $radius): self
    {
        $this->radius = $radius;

        return $this;
    }
}
