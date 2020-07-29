<?php

namespace App\DataFixtures;

use App\Entity\Link;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LinkFixtures extends Fixture
{
    const LINKS = [
        'linkedin' => 'https://www.linkedin.com/company/job-tech-fr/about/',
        'contact' => 'contact@jobtech.com',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LINKS as $identifier => $content) {
            $link = new Link();
            $link
                ->setIdentifier($identifier)
                ->setContent($content);
            $manager->persist($link);
        }

        $manager->flush();
    }
}
