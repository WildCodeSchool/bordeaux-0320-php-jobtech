<?php

namespace App\Tests\Service;

use App\Service\NumberProcessing;
use PHPUnit\Framework\TestCase;

class NumberProcessingTest extends TestCase
{
    public function testAddPointToPhoneNumber(): void
    {
        self::assertEquals('06.66.66.66.66', NumberProcessing::addPointToPhoneNumber('0666666666'));
    }
}
