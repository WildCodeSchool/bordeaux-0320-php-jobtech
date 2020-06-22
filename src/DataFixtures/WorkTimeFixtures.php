<?php

namespace App\DataFixtures;

use App\Entity\WorkTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkTimeFixtures extends Fixture
{
    const DURATIONS = [
        WorkTime::FULL_TIME['identifier'] => WorkTime::FULL_TIME['title'],
        WorkTime::PARTIAL_TIME['identifier'] => WorkTime::PARTIAL_TIME['title'],
        WorkTime::HALF_TIME['identifier'] => WorkTime::HALF_TIME['title'],
    ];

    public function load(ObjectManager $manager)
    {
        $num = 1;
        foreach (self::DURATIONS as $identifier => $durationTitle) {
            $workTime = new WorkTime();
            $workTime->setTitle($durationTitle)
                ->setIdentifier($identifier);
            $manager->persist($workTime);
            $this->addReference('workTime_' . $num, $workTime);
            $num++;
        }

        $manager->flush();
    }
}
