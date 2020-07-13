<?php

namespace App\Entity;

use App\Repository\WorkTimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkTimeRepository::class)
 */
class WorkTime
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
     * @ORM\Column(type="string", length=45)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="workTime", orphanRemoval=true)
     */
    private $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

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
     * @return string|null
     */
    public function getTitle(): ?string
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
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setWorkTime($this);
        }

        return $this;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->contains($offer)) {
            $this->offers->removeElement($offer);
            // set the owning side to null (unless already changed)
            if ($offer->getWorkTime() === $this) {
                $offer->setWorkTime(null);
            }
        }

        return $this;
    }
}
