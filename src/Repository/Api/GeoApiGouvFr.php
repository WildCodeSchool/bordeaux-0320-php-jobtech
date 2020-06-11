<?php

namespace App\Repository\Api;

use App\Service\GeoApiDataProcessing;
use Symfony\Component\HttpClient\HttpClient;

/**
 * <b>Two API developed by the french government.</b> <br><br>
 *
 * <b>API Adresse :</b>
 * API Searching and locating addresses and locations. <br>
 * https://geo.api.gouv.fr/adresse <br><br>
 *
 * <b>API Découpage administratif :</b>
 * API searching and locating city, departments and regions, and obtain information about them. <br>
 * https://geo.api.gouv.fr/decoupage-administratif
 */
class GeoApiGouvFr
{
    private function makeRequest(string $request)
    {
        $client = HttpClient::create();
        return $client->request('GET', $request);
    }

    public function getCityByPostalCode(int $postalCode)
    {
        $request = 'https://geo.api.gouv.fr/communes?codePostal=' . $postalCode;
        $result = $this->makeRequest($request);
        $result = $result->toArray();
        return GeoApiDataProcessing::cityProcessing($result);
    }
}
