<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractFixtures extends Fixture
{
    const CONTRACTS = [
        Contract::CDI['identifier'] => Contract::CDI['title'],
        Contract::CDD['identifier'] => Contract::CDD['title'],
        Contract::FREELANCE['identifier'] => Contract::FREELANCE['title'],
        Contract::STAGE['identifier'] => Contract::STAGE['title'],
        Contract::ALTERNANCE['identifier'] => Contract::ALTERNANCE['title'],
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
