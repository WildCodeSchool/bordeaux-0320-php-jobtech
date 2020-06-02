<?php

namespace App\Entity;

use App\Repository\RadiusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RadiusRepository::class)
 */
class Radius
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $radius;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRadius(): ?int
    {
        return $this->radius;
    }

    public function setRadius(int $radius): self
    {
        $this->radius = $radius;

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
}
