<?php

namespace App\Tests\Service;

use App\Service\DateManager;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateManagerTest extends TestCase
{
    public function testDateIntervalBetweenNowAnd(): void
    {
        $datetime = new DateTime('1992-07-10 12:05:00');
        $interval = $datetime->diff(new DateTime())->format('%Y-%M-%D %H:%I:%S');
        $intervalTested = DateManager::dateIntervalBetweenNowAnd($datetime)->format('%Y-%M-%D %H:%I:%S');
        self::assertEquals($interval, $intervalTested);
    }

    public function testCalculateAge(): void
    {
        $datetime = new DateTime('1992-07-10 12:05:00');
        $age = $datetime->diff(new DateTime())->y;
        self::assertEquals($age, $datetime->diff(new DateTime())->y);
    }
}
