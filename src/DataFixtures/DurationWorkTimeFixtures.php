<?php

namespace App\DataFixtures;

use App\Entity\DurationWorkTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DurationWorkTimeFixtures extends Fixture
{
    const DURATIONS = [
        DurationWorkTime::FULL_TIME['identifier'] => DurationWorkTime::FULL_TIME['title'],
        DurationWorkTime::PARTIAL_TIME['identifier'] => DurationWorkTime::PARTIAL_TIME['title'],
        DurationWorkTime::HALF_TIME['identifier'] => DurationWorkTime::HALF_TIME['title'],
    ];
    public function load(ObjectManager $manager)
    {
        $num = 1;
        foreach (self::DURATIONS as $identifier => $durationTitle) {
            $durationWorkTime = new DurationWorkTime();
            $durationWorkTime->setTitle($durationTitle)
                ->setIdentifier($identifier);
            $manager->persist($durationWorkTime);
            $this->addReference('duration_' . $num, $durationWorkTime);
            $num++;
        }

        $manager->flush();
    }
}
