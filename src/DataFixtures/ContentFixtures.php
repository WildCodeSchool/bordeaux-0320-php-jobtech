<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{
    const CONTENTS = [
        Content::ABOUT,
        Content::CONFIDENTIAL_POLITICS,
        Content::FAQ,
        Content::LEGAL_MENTIONS,
        Content::PERSONAL_DATA,
        Content::TERMS_AND_CONDITIONS
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CONTENTS as $page) {
            $content = new Content();
            $content->setTitle($page['title'])
                ->setIdentifier($page['identifier'])
                ->setHtml($page['html']);
            $manager->persist($content);
        }

        $manager->flush();
    }
}
