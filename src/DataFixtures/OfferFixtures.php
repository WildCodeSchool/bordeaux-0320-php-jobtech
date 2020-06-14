<?php

namespace App\DataFixtures;

use App\Entity\Job;
use App\Entity\Offer;
use App\Repository\Api\GeoApiFrGov;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    const OFFERS = [
        'job_1' => [
            'postal_code' => '33700',
            'city' => 'Mérignac',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_1',
        ],
        'job_3' => [
            'postal_code' => '33600',
            'city' => 'Pessac',
            'country' => 'Luxembourg',
            'duration' => 'duration_2',
            'contract' => 'contract_2',
        ],
        'job_4' => [
            'postal_code' => '33000',
            'city' => 'Bacalan',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_1',
        ],
        'job_5' => [
            'postal_code' => '37200',
            'city' => 'Tours',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_1',
        ],
        'job_17' => [
            'postal_code' => '28029',
            'city' => 'Madrid',
            'country' => 'Espagne',
            'duration' => 'duration_2',
            'contract' => 'contract_3',
        ],
        'job_18' => [
            'postal_code' => '29200',
            'city' => 'Brest',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_1',
        ],
        'job_19' => [
            'postal_code' => '06206',
            'city' => 'Nice',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_4',
        ],
        'job_2' => [
            'postal_code' => '87069',
            'city' => 'Limoges',
            'country' => 'France',
            'duration' => 'duration_2',
            'contract' => 'contract_1',
        ],
        'job_6' => [
            'postal_code' => '54100',
            'city' => 'Nancy',
            'country' => 'France',
            'duration' => 'duration_1',
            'contract' => 'contract_5',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $apiFrGov = new GeoApiFrGov();
        foreach (self::OFFERS as $jobReference => $data) {
            $job = $manager->find(Job::class, $this->getReference($jobReference));
            $nbJobCategory = count($job->getJobCategory());
            $offer = new Offer();
            $offer->setTitle($faker->sentence(2))
                ->setDescription($faker->sentence())
                ->setPostalCode($data['postal_code'])
                ->setCity($data['city'])
                ->setCountry($data['country'])
                ->setDuration($this->getReference($data['duration']))
                ->setCompany($this->getReference('company_' . rand(1, 50)))
                ->setContract($this->getReference($data['contract']))
                ->setJob($job)
                ->setJobCategory($this->getReference('job_category_' . rand(1, $nbJobCategory)));
            $manager->persist($offer);
        }

        for ($i = 1; $i <= 50; $i++) {
            do {
                $city = $apiFrGov->getCityByCode(rand(10, 95) . '0' . rand(10, 99));
            } while (!$city);
            $job = $manager->find(Job::class, $this->getReference('job_' . rand(1, 34)));
            $nbJobCategory = count($job->getJobCategory());
            $offer = new Offer();
            $offer->setTitle($faker->sentence(2))
                ->setDescription($faker->sentence())
                ->setPostalCode($city[0]['codesPostaux'][0])
                ->setCity($city[0]['nom'])
                ->setCountry('France')
                ->setDuration($this->getReference('duration_' . rand(1, 3)))
                ->setCompany($this->getReference('company_' . $i))
                ->setContract($this->getReference('contract_' . rand(1, 5)))
                ->setJob($job)
                ->setJobCategory($this->getReference('job_category_' . rand(1, $nbJobCategory)));
            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ContractFixtures::class, CompanyFixtures::class, JobFixtures::class];
    }
}
