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

        for ($i = 0; $i < 10; $i++) {
            $ability = new Ability();

            $ability->setTitle($faker->word());

            $manager->persist($ability);

            $this->addReference('ability_' . $i, $ability);
        }

        $manager->flush();
    }
}
