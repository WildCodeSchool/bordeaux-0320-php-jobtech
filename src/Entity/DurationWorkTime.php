<?php

namespace App\Entity;

use App\Repository\DurationWorkTimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DurationWorkTimeRepository::class)
 */
class DurationWorkTime
{
    const FULL_TIME = ['identifier' => 'temps_plein', 'title' => 'Temps plein'];
    const HALF_TIME = ['identifier' => 'mi_temps', 'title' => 'Mi-temps'];
    const PARTIAL_TIME = ['identifier' =>'temps_partiel', 'title' => 'Temps partiel'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $identifier;

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
}
