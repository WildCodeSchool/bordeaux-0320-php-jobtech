<?php

namespace App\Entity;

use App\Repository\ApplyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplyRepository::class)
 */
class Apply
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $applyOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplyOn(): ?\DateTimeInterface
    {
        return $this->applyOn;
    }

    public function setApplyOn(\DateTimeInterface $applyOn): self
    {
        $this->applyOn = $applyOn;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
