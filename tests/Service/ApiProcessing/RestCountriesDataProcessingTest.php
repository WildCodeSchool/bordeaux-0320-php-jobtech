<?php

namespace App\Tests\Service\ApiProcessing;

use App\Service\ApiProcessing\RestCountriesDataProcessing;
use PHPUnit\Framework\TestCase;

class RestCountriesDataProcessingTest extends TestCase
{
    public function testRestructuringArray(): void
    {
        $result = ['France' => 'FR', 'Republic of Kosovo' => 'XK'];
        self::assertEquals($result, RestCountriesDataProcessing::restructuringArray([
            [
                "name" => "France",
                "alpha2Code" => 'FR',
                "translations" => [
                    "fr" => "France"
                ],
            ],
            [
                "name" => "Republic of Kosovo",
                'alpha2Code' => 'XK',
                "translations" => [
                    "fr" => null,
                ]
            ]
        ]));
    }
}
