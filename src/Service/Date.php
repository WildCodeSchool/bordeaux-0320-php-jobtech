<?php


namespace App\Service;

use DateInterval;
use DateTime;
use DateTimeInterface;

class Date
{

    public static function dateIntervalBetweenNowAnd(DateTimeInterface $date): DateInterval
    {
        $now = new DateTime();

        return $date->diff($now);
    }
}
