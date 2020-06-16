<?php


namespace App\Entity\Search;

class OfferSearch
{
    /**
     * @var string
     */
    public $query;

    /**
     * @var string
     */
    public $job;

    /**
     * @var string
     */
    public $contract;

    /**
     * @var string
     */
    public $duration;

    public function checkIfFormIsEmpty()
    {
        $result = false;

        if ($this->query === null
            && $this->job === null
            && $this->duration === null
            && $this->contract === null
        ) {
            $result = true;
        }
        return $result;
    }
}
