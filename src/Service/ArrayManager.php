<?php

namespace App\Service;

use App\Entity\Apply;

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
}
