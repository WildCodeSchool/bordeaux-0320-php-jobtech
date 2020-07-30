<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    private const IMAGES = [
        Image::INDEX, Image::INDEX_DESC, Image::INDEX_SECTOR, Image::LOGIN, Image::MESSAGING, Image::OFFER_LIST,
        Image::OFFER_NEW, Image::REGISTER_CANDIDATE, Image::REGISTER_COMPANY
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::IMAGES as $image) {
            $newImage = new Image();
            $newImage
                ->setTitle($image['title'])
                ->setIdentifier($image['identifier'])
                ->setImage($image['image']);
            $manager->persist($newImage);
        }

        $manager->flush();
    }
}
