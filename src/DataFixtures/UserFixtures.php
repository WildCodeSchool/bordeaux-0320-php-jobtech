<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    const ADMIN = [
        'erpeldinger.g@free.fr' => [
            'roles' => ['ROLE_ADMIN'],
            'user_information' => 'adminInformation_1'
        ],
        'bocom@hotmail.fr' => [
            'roles' => ['ROLE_ADMIN'],
            'user_information' => 'adminInformation_2'
        ],
        'quentin.adadain@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'user_information' => 'adminInformation_3'
        ],
        'yaxaprod@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'user_information' => 'adminInformation_4'
        ],
    ];

    const CANDIDAT_TEST = [
        'start_email' => 'candidat',
        'end_email' => '@test.com',
        'roles' => ['ROLE_CANDIDATE'],
        'user_information' => 'candidatInformation_'
    ];

    const COMPANY_TEST = [
        'start_email' => 'company',
        'end_email' => '@test.com',
        'roles' => ['ROLE_COMPANY'],
        'company' => 'company_'
    ];

    const PASSWORD_TEST = 'JobTech33#';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getDependencies()
    {
        return [CandidateFixtures::class, CompanyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::ADMIN as $email => $data) {
            $admin = new User();
            $adminInfo = $manager->find('App:Candidate', $this->getReference($data['user_information']));
            $admin->setEmail($email)
                ->setRoles($data['roles'])
                ->setPassword($this->passwordEncoder->encodePassword($admin, self::PASSWORD_TEST))
                ->setCandidate($adminInfo);
            $manager->persist($admin);
        }

        for ($i = 1; $i < 21; $i++) {
            $candidat = new User();
            $candidatInfo = $manager->find(
                'App:Candidate',
                $this->getReference(self::CANDIDAT_TEST['user_information'] . $i)
            );
            $candidat->setEmail(self::CANDIDAT_TEST['start_email'] . $i . self::CANDIDAT_TEST['end_email'])
                ->setRoles(self::CANDIDAT_TEST['roles'])
                ->setPassword($this->passwordEncoder->encodePassword($candidat, self::PASSWORD_TEST))
                ->setCandidate($candidatInfo);
            $manager->persist($candidat);
        }

        for ($i = 1; $i < 51; $i++) {
            $company = new User();
            $companyInfo = $manager->find('App:Company', $this->getReference(self::COMPANY_TEST['company'] . $i));
            $company->setEmail(self::COMPANY_TEST['start_email'] . $i . self::COMPANY_TEST['end_email'])
                ->setRoles(self::COMPANY_TEST['roles'])
                ->setPassword($this->passwordEncoder->encodePassword($company, self::PASSWORD_TEST))
                ->setCompany($companyInfo);
            $manager->persist($company);
        }

        $manager->flush();
    }
}
