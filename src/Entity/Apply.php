<?php

namespace App\Entity;

use App\Repository\ApplyRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplyRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\ManyToOne(targetEntity=Candidate::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="applies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $applyAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Candidate|null
     */
    public function getUser(): ?Candidate
    {
        return $this->user;
    }

    /**
     * @param Candidate|null $user
     * @return $this
     */
    public function setUser(?Candidate $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer|null $offer
     * @return $this
     */
    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getApplyAt(): ?DateTimeInterface
    {
        return $this->applyAt;
    }

    /**
     * @ORM\PrePersist()
     * @return $this
     */
    public function setApplyAt(): self
    {
        $this->applyAt = new DateTime();

        return $this;
    }
}
