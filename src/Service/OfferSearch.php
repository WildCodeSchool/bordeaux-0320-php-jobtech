<?php


namespace App\Service;

class OfferSearch
{
    /**
     * @var string
     */
    public string $que = '';

    /**
     * @var string
     */
    public string $job = '';

    /**
     * @var string
     */
    public string $contract = '';

    /**
     * @var null|integer
     */
    public ?int $max;

    /**
     * @var null|integer
     */
    public ?int $min;
}
