<?php

namespace App\Entity;

use App\Repository\CurriculumVitaeRepository;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CurriculumVitaeRepository::class)
 * @Vich\Uploadable
 */
class CurriculumVitae implements Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="curriculum_vitae", fileNameProperty="cvName", size="cvSize")
     * @var File|null
     */
    private $cvFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $cvName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $cvSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Candidate::class, mappedBy="curriculumVitae", cascade={"persist", "remove"})
     */
    private $candidate;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $cvFile
     */
    public function setCvFile(?File $cvFile = null): void
    {
        $this->cvFile = $cvFile;

        if (null !== $cvFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function setCvName(?string $cvName): void
    {
        $this->cvName = $cvName;
    }

    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    /**
     * Used for naming CV when upload
     */
    public function getCvTitle(): string
    {
        $candidate = $this->getCandidate();
        return $candidate->getFirstName() . '-' . $candidate->getSurname() . '-CV';
    }

    public function setCvSize(?int $cvSize): void
    {
        $this->cvSize = $cvSize;
    }

    public function getCvSize(): ?int
    {
        return $this->cvSize;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function serialize()
    {
        return serialize($this->getId());
    }

    public function unserialize($serialized)
    {
        $this->id = unserialize($serialized);
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        // set (or unset) the owning side of the relation if necessary
        $newCurriculumVitae = null === $candidate ? null : $this;
        if ($candidate->getCurriculumVitae() !== $newCurriculumVitae) {
            $candidate->setCurriculumVitae($newCurriculumVitae);
        }

        return $this;
    }
}
