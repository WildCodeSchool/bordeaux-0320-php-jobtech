<?php

namespace App\Tests\Service;

use App\Service\NumberManager;
use PHPUnit\Framework\TestCase;

class NumberManagerTest extends TestCase
{
    public function testAddPointToPhoneNumber(): void
    {
        self::assertEquals('06.66.66.66.66', NumberManager::addPointToPhoneNumber('0666666666'));
    }
}
