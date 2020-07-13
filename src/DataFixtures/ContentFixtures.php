<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{
    const CONTENTS = [
        'about' => Content::ABOUT,
        'politics' => Content::CONFIDENTIAL_POLITICS,
        'faq' => Content::FAQ,
        'legal_mentions' => Content::LEGAL_MENTIONS,
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
