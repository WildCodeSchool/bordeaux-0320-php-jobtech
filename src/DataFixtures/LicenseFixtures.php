<?php

namespace App\DataFixtures;

use App\Entity\License;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LicenseFixtures extends Fixture
{
    const LICENSES = [
        'AM' => 'Permis cyclomoteur',
        'A1' => 'Permis Moto : 125cm3',
        'A2' => 'Permis Moto : - de 35kw',
        'A' => 'Permis Moto : + de 35kw',
        'B' => 'Permis Voiture ou camionnette',
        'B1' => 'Permis Quadricycle lourd à moteur',
        'BE' => 'Permis Voiture + remorque de plus de 750kg',
        'C' => 'Permis Poids Lourd : + de 7,5t',
        'CE' => 'Permis Poids Lourd : + de 7,5t avec remorque',
        'C1' => 'Permis Poids Lourd : entre 3,5t et 7,5t',
        'C1E' => 'Permis Poids Lourd : entre 3,5t et 7,5t avec remorque',
        'D' => 'Permis Transport : + de 8 passagers',
        'DE' => 'Permis Transport : + de 8 passagers avec remorque',
        'D1' => 'Permis Transport : 16 passagers maximum',
        'D1E' => 'Permis Transport : 16 passagers maximum avec remorque'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LICENSES as $title => $description) {
            $license = new License();
            $license->setTitle($title);
            $license->setDescription($description);
            $this->addReference('permis_' . $title, $license);
            $manager->persist($license);
        }

        $manager->flush();
    }
}
