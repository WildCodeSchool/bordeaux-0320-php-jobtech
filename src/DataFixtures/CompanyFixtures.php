<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    const POSTAL_CODE = 33100;

    const CITY = 'Bordeaux';

    const COUNTRY = 'France';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i < 21; $i++) {
            $address = $faker->biasedNumberBetween(1, 100, 'sqrt');
            $address .= ' rue ';
            $roadName = $faker->words(rand(1, 2), true);
            if (is_string($roadName)) {
                $address .= $roadName;
            }
            $company = new Company();
            $company->setName($faker->company)
                ->setSiret($faker->creditCardNumber)
                ->setPostalCode(self::POSTAL_CODE)
                ->setCity(self::CITY)
                ->setCountry(self::COUNTRY)
                ->setAddress($address);
            $this->addReference('company_' . $i, $company);
            $manager->persist($company);
        }

        $manager->flush();
    }
}
