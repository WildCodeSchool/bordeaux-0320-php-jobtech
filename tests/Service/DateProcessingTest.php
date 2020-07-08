<?php

namespace App\Tests\Service;

use App\Service\DateProcessing;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateProcessingTest extends TestCase
{
    public function testDateIntervalBetweenNowAnd(): void
    {
        $datetime = new DateTime('1992-07-10 12:00:00');
        $interval = $datetime->diff(new DateTime())->format('%Y-%M-%D %H:%I:%S');
        $intervalTested = DateProcessing::dateIntervalBetweenNowAnd($datetime)->format('%Y-%M-%D %H:%I:%S');
        self::assertEquals($interval, $intervalTested);
    }

    public function testCalculateAge(): void
    {
        $datetime = new DateTime('1992-07-10 12:00:00');
        self::assertEquals(27, $datetime->diff(new DateTime())->y);
    }
}
