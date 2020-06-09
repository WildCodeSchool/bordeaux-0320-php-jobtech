<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    const OFFERS = [
        'Maçon' => [
            'description' => 'Faire de la maçonnerie',
            'postal_code' => '33200',
            'city' => 'Mérignac',
            'country' => 'France',
            'duration' => '1 semaine',
        ],
        'Ingénieur' => [
            'description' => 'Faire des trucs d\'ingénieur',
            'postal_code' => '33000',
            'city' => 'Pessac',
            'country' => 'Luxembourg',
            'duration' => '3 mois',
        ],
        'Tailleur de pierres' => [
            'description' => 'Faire de la taille de pierre',
            'postal_code' => '33400',
            'city' => 'Bacalan',
            'country' => 'France',
            'duration' => '6 mois',
        ],
        'Grutier' => [
            'description' => 'Manier une grue',
            'postal_code' => '1000',
            'city' => 'Tours',
            'country' => 'France',
            'duration' => '1 an',
        ],
        'Couvreur' => [
            'description' => 'Couvrir des toits avec des tuiles',
            'postal_code' => '4000',
            'city' => 'Madrid',
            'country' => 'Espagne',
            'duration' => 'CDI',
        ],
        'Plâtrier' => [
            'description' => 'Faire du plâtre et du placo',
            'postal_code' => '3000',
            'city' => 'Brest',
            'country' => 'France',
            'duration' => 'CDI',
        ],
        'Forgeron' => [
            'description' => 'Forger du métal',
            'postal_code' => '22300',
            'city' => 'Nice',
            'country' => 'France',
            'duration' => '2 ans',
        ],
        'Développeur web' => [
            'description' => 'Développer sites internet et applications mobiles',
            'postal_code' => '20400',
            'city' => 'Limoges',
            'country' => 'France',
            'duration' => 'CDI',
        ],
        'Chef de chantier' => [
            'description' => 'Veiller au bon déroulement des chantiers',
            'postal_code' => '12750',
            'city' => 'Nancy',
            'country' => 'France',
            'duration' => 'CDI',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OFFERS as $offerName => $data) {
            $offer = new Offer();
            $offer->setTitle($offerName)
                ->setDescription($data['description'])
                ->setPostalCode($data['postal_code'])
                ->setCity($data['city'])
                ->setCountry($data['country'])
                ->setDuration($data['duration'])
                ->setCompany($this->getReference('company_' . rand(1, 50)))
                ->setContract($this->getReference('contract_' . rand(1, 6)))
                ->setJob($this->getReference('job_' . rand(0, 34)));
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ContractFixtures::class, CompanyFixtures::class, JobFixtures::class];
    }
}
