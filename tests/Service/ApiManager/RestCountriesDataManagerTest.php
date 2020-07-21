<?php

namespace App\Tests\Service\ApiManager;

use App\Service\ApiManager\RestCountriesDataManager;
use PHPUnit\Framework\TestCase;

class RestCountriesDataManagerTest extends TestCase
{
    public function testRestructuringArray(): void
    {
        $result = ['France' => 'FR', 'Republic of Kosovo' => 'XK'];
        self::assertEquals($result, RestCountriesDataManager::restructuringArray([
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
