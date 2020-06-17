<?php

namespace App\DataFixtures;

use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenderFixtures extends Fixture
{
    const GENDER = [
        Gender::MALE['identifier'] => [
            'title' => Gender::MALE['title'],
            'acronym' => Gender::MALE['acronym'],
        ],
        Gender::FEMALE['identifier'] => [
            'title' => Gender::FEMALE['title'],
            'acronym' => Gender::FEMALE['acronym'],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $num = 0;
        foreach (self::GENDER as $identifier => $data) {
            $gender = new Gender();
            $gender->setTitle($data['title'])
                ->setAcronym($data['acronym'])
                ->setIdentifier($identifier);
            $manager->persist($gender);
            $this->addReference('gender_' . $num, $gender);
            $num++;
        }

        $manager->flush();
    }
}
