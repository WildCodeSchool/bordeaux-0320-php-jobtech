<?php

namespace App\Repository\Api;

use App\Service\ApiProcessing\RestCountriesDataProcessing;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Get information about countries via a restful API
 * https://restcountries.eu/
 */
class RestCountries
{
    const REQUEST_METHOD = 'GET';

    const URL = 'https://restcountries.eu/rest/v2/';
    const GET_ALL = 'all';
    const GET_BY_CODE_COUNTRY = 'alpha/';

    /**
     * @param string $request
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function makeRequest(string $request)
    {
        $client = HttpClient::create();
        return $client->request(self::REQUEST_METHOD, self::URL . $request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getAllCountries(): array
    {
        $result = $this->makeRequest(self::GET_ALL);
        $result = $result->toArray();
        return RestCountriesDataProcessing::restructuringArray($result);
    }

    /**
     * Search a country by code ISO 3166-1 2-letter. Example : France -> FR
     * @param string $code
     * @return string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCountryByCode(string $code): string
    {
        $result = $this->makeRequest(self::GET_BY_CODE_COUNTRY . $code);
        return $result->toArray()['translations']['fr'];
    }
}
