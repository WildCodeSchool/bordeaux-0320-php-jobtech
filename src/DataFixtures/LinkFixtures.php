<?php

namespace App\DataFixtures;

use App\Entity\Link;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LinkFixtures extends Fixture
{
    private const LINKS = [
        Link::LINKEDIN['identifier'] => Link::LINKEDIN['content'],
        Link::CONTACT['identifier'] => Link::CONTACT['content'],
        Link::CREATE_CV['identifier'] => Link::CREATE_CV['content']
    ];

    public function load(ObjectManager $manager): void
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
