<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [AbilityFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 50; $j++) {
                $question = new Question();
                $question->setQuestion($faker->sentence(8))
                    ->setAbility($this->getReference('ability_' . $i));

                $manager->persist($question);
            }
        }
        $manager->flush();
    }
}
