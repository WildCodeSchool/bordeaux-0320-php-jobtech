<?php


namespace App\Service;

use DateInterval;
use DateTime;

class DateManager
{

    public static function dateIntervalBetweenNowAnd(?DateTime $date): DateInterval
    {
        $now = new DateTime();

        return $date->diff($now);
    }

    public static function calculateAge(?DateTime $birthday): int
    {
        return self::dateIntervalBetweenNowAnd($birthday)->y;
    }
}
