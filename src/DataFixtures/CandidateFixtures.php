<?php

namespace App\DataFixtures;

use App\Entity\Candidate;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CandidateFixtures extends Fixture implements DependentFixtureInterface
{
    const ADMIN = [
        [
            'surname' => 'Erpeldinger',
            'firstname' => 'Guillaume',
            'birthday' => '1992-07-10',
            'gender' => 'gender_0',
            'isHandicapped' => false,
            'isContactableTel' => true,
            'isContactableEmail' => true,
            'haveVehicle' => true,
        ],
        [
            'surname' => 'Dureau',
            'firstname' => 'Ludovic',
            'birthday' => '1992-07-10',
            'gender' => 'gender_0',
            'isHandicapped' => false,
            'isContactableTel' => true,
            'isContactableEmail' => true,
            'haveVehicle' => true,
        ],
        [
            'surname' => 'Adadain',
            'firstname' => 'Quentin',
            'birthday' => '1992-07-10',
            'gender' => 'gender_0',
            'isHandicapped' => false,
            'isContactableTel' => true,
            'isContactableEmail' => true,
            'haveVehicle' => true,
        ],
        [
            'surname' => 'Ardilouze',
            'firstname' => 'Timothée',
            'birthday' => '1992-07-10',
            'gender' => 'gender_0',
            'isHandicapped' => false,
            'isContactableTel' => true,
            'isContactableEmail' => true,
            'haveVehicle' => true,
        ],
    ];

    const PREFIX_PHONE = 06;
    const PREFIX_PHONE_HOME = 05;
    const POSTAL_CODE = 33100;
    const CITY = 'Bordeaux';
    const COUNTRY = 'FR';

    public function getDependencies()
    {
        return [GenderFixtures::class, LicenseFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        foreach (self::ADMIN as $i => $data) {
            $birthday = new DateTime($data['birthday']);
            $phoneNumber = self::PREFIX_PHONE . $faker->randomNumber(8, true);
            $otherNumber = self::PREFIX_PHONE_HOME . $faker->randomNumber(8, true);
            $admin = new Candidate();
            $admin->setSurname($data['surname'])
                ->setFirstname($data['firstname'])
                ->setBirthday($birthday)
                ->setGender($this->getReference($data['gender']))
                ->setPhoneNumber((int)$phoneNumber)
                ->setOtherNumber((int)$otherNumber)
                ->setPostalCode(self::POSTAL_CODE)
                ->setCity(self::CITY)
                ->setCountry(self::COUNTRY)
                ->setIsHandicapped($data['isHandicapped'])
                ->setIsContactableTel($data['isContactableTel'])
                ->setIsContactableEmail($data['isContactableEmail'])
                ->setHaveVehicle($data['haveVehicle'])
                ->addLicense($this->getReference('permis_B'))
                ->setCurriculumVitae(uniqid() . '.pdf');
            $this->addReference('adminInformation_' . ($i + 1), $admin);
            $manager->persist($admin);
        }

        for ($i = 1; $i < 21; $i++) {
            $surname = $faker->lastName;
            $firstname = $faker->firstName;
            $birthday = $faker->dateTimeInInterval('-60 years', '+ 42 years', 'Europe/Paris');
            $phoneNumber = self::PREFIX_PHONE . $faker->randomNumber(8, true);
            $otherNumber = self::PREFIX_PHONE_HOME . $faker->randomNumber(8, true);
            $randomHandicapped = rand(1, 10000);
            $randomHandicapped = $randomHandicapped >= 9000; // Probability 90% - 10%
            $candidat = new Candidate();
            $candidat->setSurname($surname)
                ->setFirstname($firstname)
                ->setBirthday($birthday)
                ->setGender($this->getReference('gender_' . rand(0, 1)))
                ->setPhoneNumber((int)$phoneNumber)
                ->setOtherNumber((int)$otherNumber)
                ->setPostalCode(self::POSTAL_CODE)
                ->setCity(self::CITY)
                ->setCountry(self::COUNTRY)
                ->setIsHandicapped($randomHandicapped)
                ->setIsContactableTel((bool)rand(0, 1))
                ->setIsContactableEmail((bool)rand(0, 1))
                ->setHaveVehicle((bool)rand(0, 1))
                ->setCurriculumVitae(uniqid());
            $this->addReference('candidatInformation_' . $i, $candidat);
            $manager->persist($candidat);
        }

        $manager->flush();
    }
}
