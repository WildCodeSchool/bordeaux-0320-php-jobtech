<?php


namespace App\Service;

use DateInterval;
use DateTime;
use DateTimeInterface;

class DateProcessing
{

    public static function dateIntervalBetweenNowAnd(DateTime $date): DateInterval
    {
        $now = new DateTime();

        return $date->diff($now);
    }

    public static function calculateAge(DateTime $birthday): int
    {
        $interval = DateProcessing::dateIntervalBetweenNowAnd($birthday);
        return $interval->y;
    }
}
