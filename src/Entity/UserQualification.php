<?php

namespace App\Entity;

use App\Repository\UserQualificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserQualificationRepository::class)
 */
class UserQualification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=UserInformation::class, inversedBy="userQualifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userInformation;

    /**
     * @ORM\ManyToOne(targetEntity=Qualification::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $qualification;

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

    public function getUserInformation(): ?UserInformation
    {
        return $this->userInformation;
    }

    public function setUserInformation(?UserInformation $userInformation): self
    {
        $this->userInformation = $userInformation;

        return $this;
    }

    public function getQualification(): ?Qualification
    {
        return $this->qualification;
    }

    public function setQualification(?Qualification $qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }
}
