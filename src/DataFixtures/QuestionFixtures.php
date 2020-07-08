<?php

namespace App\DataFixtures;

use App\Entity\Ability;
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
        $abilities = $manager->getRepository(Ability::class)->findAll();
        $faker = Factory::create('fr_FR');
        foreach ($abilities as $ability) {
            for ($j = 0; $j < 50; $j++) {
                $question = new Question();
                $question->setQuestion($faker->sentence(8))
                    ->setAbility($ability);

                $manager->persist($question);
            }
        }
        $manager->flush();
    }
}
