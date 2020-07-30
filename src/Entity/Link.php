<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 */
class Link
{
    public const LINKEDIN = [
        'identifier' => 'linkedin',
        'content' => 'https://www.linkedin.com/company/job-tech-fr/about/'
    ];
    public const CONTACT = [
        'identifier' => 'contact',
        'content' => 'contact@jobtech.com'
    ];
    public const CREATE_CV = [
        'identifier' => 'create_cv',
        'content' => 'https://cvdesignr.com/fr'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=2083)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
