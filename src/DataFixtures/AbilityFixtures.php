<?php

namespace App\DataFixtures;

use App\Entity\Ability;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AbilityFixtures extends Fixture
{
    const PERSONAL = [
        'communiquer', 'conseiller', 'analyser', 'décider', 'contrôler', 'indépendance',
        'aptitude à apprendre', 'exactitude', 'reactivité', 'persévérance', 'resistance au stress',
        'flexibilité'
    ];

    const PROFESSIONAL = [
        'organiser', 'former', 'créer', 'produire', 'négocier', 'gérer', 'esprit d\'équipe', 'implication',
        'prise d\'initiative', 'contrôle de suivi', 'disposition à apprendre'
    ];

    public function load(ObjectManager $manager)
    {
        $num = 0;
        foreach (self::PERSONAL as $personalAbility) {
            $ability = new Ability();
            $ability->setTitle($personalAbility)
                ->setNbQuestion(rand(3, 10))
                ->setIsProfessional(false);
            $this->addReference('personalAbility_' . $num, $ability);
            $manager->persist($ability);

            $num++;
        }

        $num = 0;
        foreach (self::PROFESSIONAL as $professionalAbility) {
            $ability = new Ability();
            $ability->setTitle($professionalAbility)
                ->setNbQuestion(rand(3, 10))
                ->setIsProfessional(true);
            $this->addReference('professionalAbility' . $num, $ability);
            $manager->persist($ability);

            $num++;
        }

        $manager->flush();
    }
}
