<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    const ABOUT = [
        'title' => 'A propos',
        'html' => '',
        'identifier' => 'about',
    ];

    const LEGAL_MENTIONS = [
        'title' => 'Mentions légales',
        'html' => '',
        'identifier' => 'legal_mentions',
    ];

    const FAQ = [
        'title' => 'Foire aux questions',
        'html' => '',
        'identifier' => 'faq',
    ];

    const CONFIDENTIAL_POLITICS = [
        'title' => 'Politique de confidentialité',
        'html' => '',
        'identifier' => 'confidential_politics',
    ];

    const TERMS_AND_CONDITIONS = [
        'title' => 'Conditions d\'utilisation',
        'html' => '',
        'identifier' => 'terms_and_conditions',
    ];

    const PERSONAL_DATA = [
        'title' => 'Données personnelles',
        'html' => '',
        'identifier' => 'personal_data',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $html;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function setHtml(?string $html): self
    {
        $this->html = $html;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
