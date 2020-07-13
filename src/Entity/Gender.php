<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenderRepository::class)
 */
class Gender
{
    const MALE = ['title' => 'Monsieur', 'acronym' => 'M.', 'identifier' => 'mister'];
    const FEMALE = ['title' => 'Madame', 'acronym' => 'Mme.', 'identifier' => 'madam'];

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
    private $acronym;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

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
    public function getTitle(): string
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
    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    /**
     * @param string $acronym
     * @return $this
     */
    public function setAcronym(string $acronym): self
    {
        $this->acronym = $acronym;

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
}
