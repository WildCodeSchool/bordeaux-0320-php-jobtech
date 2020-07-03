<?php

namespace App\DataFixtures;

use App\Entity\Ability;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AbilityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $abilities = [];
        for ($i = 0; $i < 10; $i++) {
            $ability = new Ability();

            do {
                $abilityTitle = $faker->word();
            } while (in_array($abilityTitle, $abilities));

            $ability->setTitle($abilityTitle);
            $abilities[] = $abilityTitle;

            $manager->persist($ability);

            $this->addReference('ability_' . $i, $ability);
        }

        $manager->flush();
    }
}
