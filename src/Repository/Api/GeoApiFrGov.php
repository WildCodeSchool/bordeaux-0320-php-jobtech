<?php

namespace App\Repository\Api;

use App\Service\ApiManager\GeoApiDataManager;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * <b>Two geolocation API developed by the french government.</b>
 * <br><br>
 * <b>API Découpage administratif</b> alias Geo Api : <br>
 * API searching and locating city, departments and regions, and obtain information about them. <br>
 * https://geo.api.gouv.fr/decoupage-administratif
 * <br><br>
 * <b>API Adresse </b> alias Address Api : <br>
 * API Searching and locating addresses and locations. <br>
 * https://geo.api.gouv.fr/adresse
 */
class GeoApiFrGov
{
    private const REQUEST_METHOD = 'GET';

    // Constant Geo Api
    private const URL_GEO_API = 'https://geo.api.gouv.fr/';
    private const GET_BY_POSTAL_CODE = 'communes?codePostal=';
    private const GET_BY_CODE = 'communes?code=';

    // Constant Address Api
    private const URL_ADDRESS_API = 'https://api-adresse.data.gouv.fr/';

    /**
     * @param string $request
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    private function makeRequest(string $request)
    {
        $client = HttpClient::create();
        return $client->request(self::REQUEST_METHOD, $request);
    }

    /**
     * @param int $postalCode
     * @return array|string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCityByPostalCode(int $postalCode)
    {
        $request = self::URL_GEO_API . self::GET_BY_POSTAL_CODE . $postalCode;
        $result = $this->makeRequest($request);
        $result = $result->toArray();
        return GeoApiDataManager::cityProcessing($result);
    }

    /**
     * @param int $code
     * @return array|string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCityByCode(int $code)
    {
        $request = self::URL_GEO_API . self::GET_BY_CODE . $code;
        $result = $this->makeRequest($request);
        return $result->toArray();
    }
}
