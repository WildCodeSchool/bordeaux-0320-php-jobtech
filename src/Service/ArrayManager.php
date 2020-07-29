<?php

namespace App\Service;

use App\Entity\Apply;
use App\Entity\Job;

class ArrayManager
{
    /**
     * @param Apply[] $applies
     * @return array
     */
    public static function getOffersFromApplies(array $applies): array
    {
        $result = [];
        foreach ($applies as $apply) {
            $result[] = $apply->getOffer();
        }

        return $result;
    }

    /**
     * @param Job[] $jobs
     * @return array
     */
    public static function prepareJobsForSelect(array $jobs): array
    {
        $result = [];
        foreach ($jobs as $job) {
            $result[] = [
                'id' => $job->getId(),
                'title' => $job->getTitle()
            ];
        }
        return $result;
    }
}
