<?php

namespace App\DataFixtures;

use App\Entity\JobCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobCategoryFixtures extends Fixture
{
    const JOB_CATEGORY = [
        'Aéronautique' => ['icon' => 'fas fa-plane', 'identifier' => 'aero'],
        'Mécanique' => ['icon' => 'fas fa-wrench', 'identifier' => 'meca'],
        'Structure béton' => ['icon' => 'fas fa-archway', 'identifier' => 'concrete'],
        'Structure bois' => ['icon' => 'fas fa-tree', 'identifier' => 'wood'],
        'Charpente métallique' => ['icon' => 'fas fa-building', 'identifier' => 'metal'],
        'Génie climatique (CVC)' => ['icon' => 'fas fa-temperature-low', 'identifier' => 'clima'],
        'Génie électrique' => ['icon' => 'fas fa-charging-station', 'identifier' => 'elec'],
        'Tôlerie' => ['icon' => 'fab fa-accusoft', 'identifier' => 'sheet-metal'],
        'Environnement Écologie' => ['icon' => 'fab fa-envira', 'identifier' => 'ecolo'],
        'Système' => ['icon' => 'fas fa-lightbulb', 'identifier' => 'system'],
        'Bâtiment' => ['icon' => 'fas fa-hard-hat', 'identifier' => 'construct'],
        'VRD' => ['icon' => 'fas fa-route', 'identifier' => 'road'],
        'Optique' => ['icon' => 'fas fa-eye', 'identifier' => 'optic'],
    ];

    public function load(ObjectManager $manager)
    {
        $num = 1;
        foreach (self::JOB_CATEGORY as $category => $data) {
            $jobCategory = new JobCategory();
            $jobCategory->setTitle($category)
                ->setIcon($data['icon'])
                ->setIdentifier($data['identifier']);
            $this->addReference('job_category_' . $num, $jobCategory);
            $num++;
            $manager->persist($jobCategory);
        }

        $manager->flush();
    }
}
