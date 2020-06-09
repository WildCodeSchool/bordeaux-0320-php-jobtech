<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractFixtures extends Fixture
{
    const CONTRACTS = [
        'cdi' => 'CDI',
        'cdd' => 'CDD',
        'free' => 'Freelance',
        'interim' => 'Intérim',
        'stage' => 'Stage',
        'alternance' => 'Alternance',
    ];

    public function load(ObjectManager $manager)
    {
        $num = 1;
        foreach (self::CONTRACTS as $identifier => $contractName) {
            $contract = new Contract();
            $contract->setTitle($contractName)
                ->setIdentifier($identifier);
            $manager->persist($contract);
            $this->addReference('contract_' . $num, $contract);
            $num++;
        }

        $manager->flush();
    }
}
