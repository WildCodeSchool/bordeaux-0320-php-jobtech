<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    const OFFERS = [
        'job_33' => [
            'postal_code' => '33200',
            'city' => 'Mérignac',
            'country' => 'France',
            'duration' => 'Temps plein',
            'contract' => 'contract_1',
        ],
        'job_3' => [
            'postal_code' => '33000',
            'city' => 'Pessac',
            'country' => 'Luxembourg',
            'duration' => 'Mi-temps',
            'contract' => 'contract_2',
        ],
        'job_4' => [
            'postal_code' => '33400',
            'city' => 'Bacalan',
            'country' => 'France',
            'duration' => 'Temps plein',
            'contract' => 'contract_1',
        ],
        'job_5' => [
            'postal_code' => '1000',
            'city' => 'Tours',
            'country' => 'France',
            'duration' => 'Temps plein',
            'contract' => 'contract_1',
        ],
        'job_17' => [
            'postal_code' => '4000',
            'city' => 'Madrid',
            'country' => 'Espagne',
            'duration' => 'Mi-temps',
            'contract' => 'contract_3',
        ],
        'job_18' => [
            'postal_code' => '3000',
            'city' => 'Brest',
            'country' => 'France',
            'duration' => 'Temps plein',
            'contract' => 'contract_1',
        ],
        'job_19' => [
            'postal_code' => '22300',
            'city' => 'Nice',
            'country' => 'France',
            'duration' => 'Temps plein',
            'contract' => 'contract_4',
        ],
        'job_2' => [
            'postal_code' => '20400',
            'city' => 'Limoges',
            'country' => 'France',
            'duration' => 'Mi-temps',
            'contract' => 'contract_1',
        ],
        'job_6' => [
            'postal_code' => '12750',
            'city' => 'Nancy',
            'country' => 'France',
            'duration' => 'Temps Plein',
            'contract' => 'contract_5',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        foreach (self::OFFERS as $job => $data) {
            $offer = new Offer();
            $offer->setTitle($faker->sentence(3))
                ->setDescription($faker->sentence())
                ->setPostalCode($data['postal_code'])
                ->setCity($data['city'])
                ->setCountry($data['country'])
                ->setDuration($data['duration'])
                ->setCompany($this->getReference('company_' . rand(1, 50)))
                ->setContract($this->getReference($data['contract']))
                ->setJob($this->getReference($job));
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ContractFixtures::class, CompanyFixtures::class, JobFixtures::class];
    }
}
