<?php

namespace App\Tests\Service\ApiManager;

use App\Service\ApiManager\GeoApiDataManager;
use PHPUnit\Framework\TestCase;

class GeoApiDataManagerTest extends TestCase
{
    public function testCityProcessing(): void
    {
        self::assertEquals('Aucune ville trouvé.', GeoApiDataManager::cityProcessing([]));

        self::assertEquals('Bordeaux', GeoApiDataManager::cityProcessing([
            [
                "nom" => "Bordeaux",
                "code" => "33063",
                "codeDepartement" => "33",
                "codeRegion" => "75",
                "codesPostaux" => [
                    0 => "33000",
                    1 => "33300",
                    2 => "33100",
                    3 => "33090",
                    4 => "33800",
                    5 => "33200"
                ],
                "population" => 252040
            ],
        ]));

        self::assertEquals(['Pessac', 'Talence'], GeoApiDataManager::cityProcessing([
            [
                "nom" => "Pessac",
                "code" => "33318",
                "codeDepartement" => "33",
                "codeRegion" => "75",
                "codesPostaux" => [
                    0 => "33600",
                    1 => "33400",
                ],
                "population" => 61859
            ],
            [
                "nom" => "Talence",
                "code" => "33522",
                "codeDepartement" => "33",
                "codeRegion" => "75",
                "codesPostaux" => [
                    0 => "33400",
                ],
                "population" => 42712
            ],
        ]));
    }
}
