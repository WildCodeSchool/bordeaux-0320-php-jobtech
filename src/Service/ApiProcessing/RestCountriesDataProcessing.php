<?php

namespace App\Service\ApiProcessing;

class RestCountriesDataProcessing
{
    public static function restructuringArray(array $countries)
    {
        $result = [];
        foreach ($countries as $country) {
            if ($country['translations']['fr'] === null) {
                $country['translations']['fr'] = $country['name'];
            }
            $result[$country['translations']['fr']] = $country['alpha2Code'];
        }
        return $result;
    }
}
