<?php

namespace App\Service;

class GeoApiDataProcessing
{
    /**
     * @param array $cities
     * Take a array of cities from 'Api Découpage administratif'
     * @return array|string
     * Return a error message if $cities is empty. <br>
     * Return a string with the city name if only one city in $cities. <br>
     * Return a array of cities sort by number of citizens if multiple cities.
     */
    public static function cityProcessing(array $cities)
    {
        $result = 'Aucune ville trouvé.';
        if (count($cities) === 1) {
            $result = $cities[0]['nom'];
        } elseif (count($cities) > 1) {
            $result = [];
            $residents = array_column($cities, 'population');
            array_multisort($residents, SORT_DESC, $cities);
            foreach ($cities as $city) {
                $result[] = $city['nom'];
            }
        }

        return $result;
    }
}
