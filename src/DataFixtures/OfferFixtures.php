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
            'postal code' => '33200',
            'city' => 'Mérignac',
            'country' => 'France',
            'duration' => '1 semaine',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Ingénieur' => [
            'description' => 'Faire des trucs d\'ingénieur',
            'postal code' => '33000',
            'city' => 'Pessac',
            'country' => 'Luxembourg',
            'duration' => '3 mois',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Tailleur de pierres' => [
            'description' => 'Faire de la taille de pierre',
            'postal code' => '33400',
            'city' => 'Bacalan',
            'country' => 'France',
            'duration' => '6 mois',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Grutier' => [
            'description' => 'Manier une grue',
            'postal code' => '1000',
            'city' => 'Tours',
            'country' => 'France',
            'duration' => '1 an',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Couvreur' => [
            'description' => 'Couvrir des toits avec des tuiles',
            'postal code' => '4000',
            'city' => 'Madrid',
            'country' => 'Espagne',
            'duration' => 'CDI',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Plâtrier' => [
            'description' => 'Faire du plâtre et du placo',
            'postal code' => '3000',
            'city' => 'Brest',
            'country' => 'France',
            'duration' => 'CDI',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Forgeron' => [
            'description' => 'Forger du métal',
            'postal code' => '22300',
            'city' => 'Nice',
            'country' => 'France',
            'duration' => '2 ans',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Développeur web' => [
            'description' => 'Développer sites internet et applications mobiles',
            'postal code' => '20400',
            'city' => 'Limoges',
            'country' => 'France',
            'duration' => 'CDI',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
        'Chef de chantier' => [
            'description' => 'Veiller au bon déroulement des chantiers',
            'postal_code' => '12750',
            'city' => 'Nancy',
            'country' => 'France',
            'duration' => 'CDI',
            'company_id' => '1',
            'contract_id' => '1',
            'job_id' => '1',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OFFERS as $offerName => $data) {
            $offer = new Offer();
            $offer->setTitle($offerName);
            $offer->setDescription($data['description']);
            $offer->setCity($data['city']);
            $offer->setCountry($data['country']);
            $offer->setDuration($data['duration']);
            $offer->setCompany($this->getReference('company_' . rand(1, 50)));
            $offer->setContract($this->getReference('contract_' . rand(1, 6)));
            $offer->setJob($data['job']);
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ContractFixtures::class, CompanyFixtures::class, JobFixtures::class];
    }
}
