<?php

namespace App\Service;

class NumberProcessing
{
    public static function addPointToPhoneNumber(?string $phone): string
    {
        $result = '';
        for ($i = 0; $i < 10; $i++) {
            $result .= $phone[$i];
            if ($i % 2) {
                $result .= '.';
            }
        }
        return substr($result, 0, -1);
    }
}
