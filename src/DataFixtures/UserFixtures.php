<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    const ADMIN = [
        'erpeldinger.g@free.fr' => [
            'roles' => ['ROLE_ADMIN'],
            'password' => 'JobTech33#',
            'user_information' => 'adminInformation_1'
        ],
        'bocom@hotmail.fr' => [
            'roles' => ['ROLE_ADMIN'],
            'password' => 'JobTech33#',
            'user_information' => 'adminInformation_2'
        ],
        'quentin.adadain@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'password' => 'JobTech33#',
            'user_information' => 'adminInformation_3'
        ],
        'yaxaprod@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'password' => 'JobTech33#',
            'user_information' => 'adminInformation_4'
        ],
    ];

    const CANDIDAT_TEST = [
        'start_email' => 'candidat',
        'end_email' => '@test.com',
        'roles' => ['ROLE_CANDIDAT'],
        'password' => 'JobTech33#',
        'user_information' => 'candidatInformation_'
    ];

    const COMPANY_TEST = [
        'start_email' => 'company',
        'end_email' => '@test.com',
        'roles' => ['ROLE_COMPANY'],
        'password' => 'JobTech33#',
        'company' => 'company_'
    ];

    public function getDependencies()
    {
        return [UserInformationFixtures::class, CompanyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $date = new DateTime();
        foreach (self::ADMIN as $email => $data) {
            $admin = new User();
            $adminInfo = $manager->find('App:UserInformation', $this->getReference($data['user_information']));
            $admin->setEmail($email)
                ->setRoles($data['roles'])
                ->setPassword($data['password'])
                ->setCreatedOn($date)
                ->setUserInformation($adminInfo);
            $manager->persist($admin);
        }

        for ($i = 1; $i < 21; $i++) {
            $candidat = new User();
            $candidatInfo = $manager->find(
                'App:UserInformation',
                $this->getReference(self::CANDIDAT_TEST['user_information'] . $i)
            );
            $candidat->setEmail(self::CANDIDAT_TEST['start_email'] . $i . self::CANDIDAT_TEST['end_email'])
                ->setRoles(self::CANDIDAT_TEST['roles'])
                ->setPassword(self::CANDIDAT_TEST['password'])
                ->setCreatedOn($date)
                ->setUserInformation($candidatInfo);
            $manager->persist($candidat);
        }

        for ($i = 1; $i < 21; $i++) {
            $company = new User();
            $companyInfo = $manager->find('App:Company', $this->getReference(self::COMPANY_TEST['company'] . $i));
            $company->setEmail(self::COMPANY_TEST['start_email'] . $i . self::COMPANY_TEST['end_email'])
                ->setRoles(self::COMPANY_TEST['roles'])
                ->setPassword(self::COMPANY_TEST['password'])
                ->setCreatedOn($date)
                ->setCompany($companyInfo);
            $manager->persist($company);
        }

        $manager->flush();
    }
}
