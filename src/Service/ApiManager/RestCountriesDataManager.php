<?php

namespace App\Service\ApiManager;

class RestCountriesDataManager
{
    public static function restructuringArray(array $countries): array
    {
        $result = [];
        foreach ($countries as $country) {
            if ($country['translations']['fr'] === null) {
                $country['translations']['fr'] = $country['name'];
            }
            $result[$country['translations']['fr']] = $country['alpha2Code'];
        }
        ksort($result);
        return $result;
    }
}
