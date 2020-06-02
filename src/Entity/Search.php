<?php

namespace App\Entity;

use App\Repository\SearchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchRepository::class)
 */
class Search
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="searches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Contract::class)
     */
    private $contract;

    /**
     * @ORM\ManyToMany(targetEntity=Profession::class)
     */
    private $profession;

    public function __construct()
    {
        $this->contract = new ArrayCollection();
        $this->profession = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Contract[]
     */
    public function getContract(): Collection
    {
        return $this->contract;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contract->contains($contract)) {
            $this->contract[] = $contract;
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contract->contains($contract)) {
            $this->contract->removeElement($contract);
        }

        return $this;
    }

    /**
     * @return Collection|Profession[]
     */
    public function getProfession(): Collection
    {
        return $this->profession;
    }

    public function addProfession(Profession $profession): self
    {
        if (!$this->profession->contains($profession)) {
            $this->profession[] = $profession;
        }

        return $this;
    }

    public function removeProfession(Profession $profession): self
    {
        if ($this->profession->contains($profession)) {
            $this->profession->removeElement($profession);
        }

        return $this;
    }
}
