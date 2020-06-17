<?php


namespace App\Entity\Search;

use App\Entity\Contract;
use App\Entity\Job;
use App\Entity\WorkTime;

class OfferSearch
{
    /**
     * @var string
     */
    private ?string $query;

    /**
     * @var Job|null
     */
    private ?Job $job;

    /**
     * @var Contract|null
     */
    private ?Contract $contract;

    /**
     * @var WorkTime|null
     */
    private ?WorkTime $workTime;

    public function checkIfFormIsEmpty()
    {
        $result = false;

        if ($this->getQuery() === null
            && $this->getJob() === null
            && $this->getWorkTime() === null
            && $this->getWorkTime() === null
        ) {
            $result = true;
        }
        return $result;
    }

    public function __construct(
        ?string $query = null,
        ?Job $job = null,
        ?Contract $contract = null,
        ?WorkTime $workTime = null
    ) {
        $this->setQuery($query)
            ->setJob($job)
            ->setContract($contract)
            ->setWorkTime($workTime);
    }

    /**
     * @return string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return OfferSearch
     */
    public function setQuery(?string $query): OfferSearch
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return Job|null
     */
    public function getJob(): ?Job
    {
        return $this->job;
    }

    /**
     * @param Job|null $job
     * @return OfferSearch
     */
    public function setJob(?Job $job): OfferSearch
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return Contract|null
     */
    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    /**
     * @param Contract|null $contract
     * @return OfferSearch
     */
    public function setContract(?Contract $contract): OfferSearch
    {
        $this->contract = $contract;
        return $this;
    }

    /**
     * @return WorkTime|null
     */
    public function getWorkTime(): ?WorkTime
    {
        return $this->workTime;
    }

    /**
     * @param WorkTime|null $workTime
     * @return OfferSearch
     */
    public function setWorkTime(?WorkTime $workTime): OfferSearch
    {
        $this->workTime = $workTime;
        return $this;
    }
}
