<?php

namespace App\DataFixtures;

use App\Entity\JobCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobCategoryFixtures extends Fixture
{
    const JOB_CATEGORY = [
        JobCategory::AERONAUTICS['title'] => [
            'icon' => JobCategory::AERONAUTICS['icon'],
            'identifier' => JobCategory::AERONAUTICS['identifier']
        ],
        JobCategory::MECHANIC['title'] => [
            'icon' => JobCategory::MECHANIC['icon'],
            'identifier' => JobCategory::MECHANIC['identifier']
        ],
        JobCategory::CONCRETE_STRUCTURE['title'] => [
            'icon' => JobCategory::CONCRETE_STRUCTURE['icon'],
            'identifier' => JobCategory::CONCRETE_STRUCTURE['identifier']
        ],
        JobCategory::WOOD_STRUCTURE['title'] => [
            'icon' => JobCategory::WOOD_STRUCTURE['icon'],
            'identifier' => JobCategory::WOOD_STRUCTURE['identifier']
        ],
        JobCategory::STEEL_FRAME['title'] => [
            'icon' => JobCategory::STEEL_FRAME['icon'],
            'identifier' => JobCategory::STEEL_FRAME['identifier']
        ],
        JobCategory::CLIMATE_ENGINEER['title'] => [
            'icon' => JobCategory::CLIMATE_ENGINEER['icon'],
            'identifier' => JobCategory::CLIMATE_ENGINEER['identifier']
        ],
        JobCategory::ELECTRICAL_ENGINEER['title'] => [
            'icon' => JobCategory::ELECTRICAL_ENGINEER['icon'],
            'identifier' => JobCategory::ELECTRICAL_ENGINEER['identifier']
        ],
        JobCategory::SHEET_METAL['title'] => [
            'icon' => JobCategory::SHEET_METAL['icon'],
            'identifier' => JobCategory::SHEET_METAL['identifier']
        ],
        JobCategory::ECOLOGICAL_ENVIRONMENT['title'] => [
            'icon' => JobCategory::ECOLOGICAL_ENVIRONMENT['icon'],
            'identifier' => JobCategory::ECOLOGICAL_ENVIRONMENT['identifier']
        ],
        JobCategory::SYSTEM['title'] => [
            'icon' => JobCategory::SYSTEM['icon'],
            'identifier' => JobCategory::SYSTEM['identifier']
        ],
        JobCategory::CONSTRUCTION['title'] => [
            'icon' => JobCategory::CONSTRUCTION['icon'],
            'identifier' => JobCategory::CONSTRUCTION['identifier']
        ],
        JobCategory::RMN['title'] => [
            'icon' => JobCategory::RMN['icon'],
            'identifier' => JobCategory::RMN['identifier']
        ],
        JobCategory::OPTIC['title'] => [
            'icon' => JobCategory::OPTIC['icon'],
            'identifier' => JobCategory::OPTIC['identifier']
        ],
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
