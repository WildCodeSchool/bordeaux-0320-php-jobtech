<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Image
{
    public const INDEX = [
        'title' => 'Index',
        'identifier' => 'index',
        'image' => 'index.jpg'
    ];

    public const INDEX_DESC = [
        'title' => 'Index description',
        'identifier' => 'index_desc',
        'image' => 'index_desc.png'
    ];

    public const INDEX_SECTOR = [
        'title' => 'Index secteur',
        'identifier' => 'index_sector',
        'image' => 'index_sector.png'
    ];

    public const LOGIN = [
        'title' => 'Connexion',
        'identifier' => 'login',
        'image' => 'login.png'
    ];

    public const MESSAGING = [
        'title' => 'Messagerie',
        'identifier' => 'messaging',
        'image' => 'messaging.png'
    ];

    public const OFFER_LIST = [
        'title' => 'Liste des offres',
        'identifier' => 'offer_list',
        'image' => 'offer_list.png'
    ];

    public const OFFER_NEW = [
        'title' => 'Nouvelle offre',
        'identifier' => 'offer_new',
        'image' => 'offer_new.png'
    ];

    public const REGISTER_CANDIDATE = [
        'title' => 'Enregistrement Candidat',
        'identifier' => 'register_candidate',
        'image' => 'register_candidate.png'
    ];

    public const REGISTER_COMPANY = [
        'title' => 'Enregistrement Entreprise',
        'identifier' => 'register_company',
        'image' => 'register_company.png'
    ];

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
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="image_index", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

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

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null): self
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
