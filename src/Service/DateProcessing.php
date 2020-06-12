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
}
