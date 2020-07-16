<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    const JOB_1 = [
        'title' => 'Chargé de communication scientifique',
        'job_category' => [
            'job_category_1',
            'job_category_2',
        ],
    ];
    const JOB_2 = [
        'title' => 'BIM Manager',
        'job_category' => [
            'job_category_3',
            'job_category_13',
            'job_category_14',
        ],
    ];
    const JOB_3 = [
        'title' => 'Responsable d\'étude',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_4 = [
        'title' => 'Chef de projet de construction',
        'job_category' => [
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_5 = [
        'title' => 'Chef de projet d\'innovation',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_9',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_6 = [
        'title' => 'Chef de projet ouvrage d\'art',
        'job_category' => [
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_7 = [
        'title' => 'Chef de projet R&D',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
        ],
    ];
    const JOB_8 = [
        'title' => 'Chiffreur',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_9 = [
        'title' => 'Directeur scientifique',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_10 = [
        'title' => 'Directeur technique',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_11 = [
        'title' => 'Chercheur',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_12 = [
        'title' => 'Ingénieur calcul',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_13 = [
        'title' => 'Ingénieur projet',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_14 = [
        'title' => 'PMO',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_15 = [
        'title' => 'Rédacteur technique',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_16 = [
        'title' => 'Responsable BE',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_17 = [
        'title' => 'Responsable technique',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_18 = [
        'title' => 'Technicien bureau d\'études',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_19 = [
        'title' => 'Technicien d\'essais',
        'job_category' => [
            'job_category_1',
            'job_category_2',
        ],
    ];
    const JOB_20 = [
        'title' => 'Technicien bâtiment',
        'job_category' => [
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_21 = [
        'title' => 'Attaché de recherche',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_9',
            'job_category_14',
        ],
    ];
    const JOB_22 = [
        'title' => 'Technicien étude de prix',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_23 = [
        'title' => 'Assistant R&D',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_24 = [
        'title' => 'Testeur',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_25 = [
        'title' => 'Technicien méthodes',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_26 = [
        'title' => 'Dessinateur CAO/DAO',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
    ];
    const JOB_27 = [
        'title' => 'Architecte structure',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_28 = [
        'title' => 'Dessinateur - Projeteur',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_29 = [
        'title' => 'Chargé d\'affaires',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_30 = [
        'title' => 'Projeteur - Calculateur',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_31 = [
        'title' => 'Assistant chargé d\'affaires',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
            'job_category_14',
            'job_category_15',
        ],
    ];
    const JOB_32 = [
        'title' => 'Métreur',
        'job_category' => [
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_33 = [
        'title' => 'Conducteur de travaux',
        'job_category' => [
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
        ],
    ];
    const JOB_34 = [
        'title' => 'Technicien maintenance',
        'job_category' => [
            'job_category_1',
            'job_category_2',
            'job_category_3',
            'job_category_4',
            'job_category_5',
            'job_category_6',
            'job_category_7',
            'job_category_8',
            'job_category_9',
            'job_category_10',
            'job_category_11',
            'job_category_12',
            'job_category_13',
        ],
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
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\ManyToMany(targetEntity=JobCategory::class, inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinTable(name="job_has_categories")
     */
    private $jobCategory;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="job", orphanRemoval=true)
     */
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity=Search::class, mappedBy="job", orphanRemoval=true)
     */
    private $searches;

    public function __construct()
    {
        $this->jobCategory = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->searches = new ArrayCollection();
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
     * @return string
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
     * @param string|null $identifier
     * @return $this
     */
    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return Collection|JobCategory[]
     */
    public function getJobCategory(): Collection
    {
        return $this->jobCategory;
    }

    /**
     * @param JobCategory $jobCategory
     * @return $this
     */
    public function addJobCategory(JobCategory $jobCategory): self
    {
        if (!$this->jobCategory->contains($jobCategory)) {
            $this->jobCategory[] = $jobCategory;
        }

        return $this;
    }

    /**
     * @param JobCategory $jobCategory
     * @return $this
     */
    public function removeJobCategory(JobCategory $jobCategory): self
    {
        if ($this->jobCategory->contains($jobCategory)) {
            $this->jobCategory->removeElement($jobCategory);
        }

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
            $offer->setJob($this);
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
            if ($offer->getJob() === $this) {
                $offer->setJob(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Search[]
     */
    public function getSearches(): Collection
    {
        return $this->searches;
    }

    /**
     * @param Search $search
     * @return $this
     */
    public function addSearch(Search $search): self
    {
        if (!$this->searches->contains($search)) {
            $this->searches[] = $search;
            $search->setJob($this);
        }

        return $this;
    }

    /**
     * @param Search $search
     * @return $this
     */
    public function removeSearch(Search $search): self
    {
        if ($this->searches->contains($search)) {
            $this->searches->removeElement($search);
            // set the owning side to null (unless already changed)
            if ($search->getJob() === $this) {
                $search->setJob(null);
            }
        }

        return $this;
    }
}
