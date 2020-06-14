<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    const JOBS = [
        Job::JOB_1['title'] => Job::JOB_1['job_category'],
        Job::JOB_2['title'] => Job::JOB_2['job_category'],
        Job::JOB_3['title'] => Job::JOB_3['job_category'],
        Job::JOB_4['title'] => Job::JOB_4['job_category'],
        Job::JOB_5['title'] => Job::JOB_5['job_category'],
        Job::JOB_6['title'] => Job::JOB_6['job_category'],
        Job::JOB_7['title'] => Job::JOB_7['job_category'],
        Job::JOB_8['title'] => Job::JOB_8['job_category'],
        Job::JOB_9['title'] => Job::JOB_9['job_category'],
        Job::JOB_10['title'] => Job::JOB_10['job_category'],
        Job::JOB_11['title'] => Job::JOB_11['job_category'],
        Job::JOB_12['title'] => Job::JOB_12['job_category'],
        Job::JOB_13['title'] => Job::JOB_13['job_category'],
        Job::JOB_14['title'] => Job::JOB_14['job_category'],
        Job::JOB_15['title'] => Job::JOB_15['job_category'],
        Job::JOB_16['title'] => Job::JOB_16['job_category'],
        Job::JOB_17['title'] => Job::JOB_17['job_category'],
        Job::JOB_18['title'] => Job::JOB_18['job_category'],
        Job::JOB_19['title'] => Job::JOB_19['job_category'],
        Job::JOB_20['title'] => Job::JOB_20['job_category'],
        Job::JOB_21['title'] => Job::JOB_21['job_category'],
        Job::JOB_22['title'] => Job::JOB_22['job_category'],
        Job::JOB_23['title'] => Job::JOB_23['job_category'],
        Job::JOB_24['title'] => Job::JOB_24['job_category'],
        Job::JOB_25['title'] => Job::JOB_25['job_category'],
        Job::JOB_26['title'] => Job::JOB_26['job_category'],
        Job::JOB_27['title'] => Job::JOB_27['job_category'],
        Job::JOB_28['title'] => Job::JOB_28['job_category'],
        Job::JOB_29['title'] => Job::JOB_29['job_category'],
        Job::JOB_30['title'] => Job::JOB_30['job_category'],
        Job::JOB_31['title'] => Job::JOB_31['job_category'],
        Job::JOB_32['title'] => Job::JOB_32['job_category'],
        Job::JOB_33['title'] => Job::JOB_33['job_category'],
        Job::JOB_34['title'] => Job::JOB_34['job_category'],
    ];

    public function getDependencies()
    {
        return [JobCategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $num = 1;
        foreach (self::JOBS as $title => $jobCategories) {
            $job = new Job();
            $job->setTitle($title);
            foreach ($jobCategories as $jobCategory) {
                $job->addJobCategory($this->getReference($jobCategory));
            }
            $manager->persist($job);
            $this->addReference('job_' . $num, $job);
            $num++;
        }

        $manager->flush();
    }
}
