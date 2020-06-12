<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    const JOBS = [
        [
            'title' => 'Chargé de communication scientifique',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'BIM Manager',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Responsable d\'étude',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chef de projet de construction',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chef de projet d\'innovation',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chef de projet ouvrage d\'art',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chef de projet R&D',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chiffreur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Directeur scientifique',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Directeur technique',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chercheur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Ingénieur calcul',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Ingénieur projet',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'PMO',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Rédacteur technique',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Responsable BE',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Responsable technique',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien bureau d\'études',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien d\'essais',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien bâtiment',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Attaché de recherche',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien étude de prix',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Assistant R&D',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Testeur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien méthodes',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Dessinateur CAO/DAO',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Architecte structure',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Dessinateur - Projeteur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Chargé d\'affaires',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Projeteur - Calculateur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Assistant chargé d\'affaires',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Métreur',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Conducteur de travaux',
            'job_category' => 'job_category_1'
        ],
        [
            'title' => 'Technicien maintenance',
            'job_category' => 'job_category_1'
        ],
    ];

    public function getDependencies()
    {
        return [JobCategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::JOBS as $key => $data) {
            $job = new Job();
            $job->setTitle($data['title'])
                ->setJobCategory($this->getReference($data['job_category']));
            $manager->persist($job);
            $this->addReference('job_' . $key, $job);
        }

        $manager->flush();
    }
}
