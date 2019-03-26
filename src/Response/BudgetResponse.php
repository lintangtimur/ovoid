<?php

namespace Stelin\Response;

class BudgetResponse
{
    private $budget;
    private $totalSpending;
    private $cycleDate;
    private $summary;

    public function __construct($decoded)
    {
        $key = array_keys((array)$decoded);
        for ($i = 0; $i < count($key); $i++) {

            $keyPriv = $key[$i];
            $this->$keyPriv = ((array)$decoded)[$key[$i]];
        }
    }

    /**
     * get budget amount 
     *
     * @return int|float
     */
    public function getBudgetAmount()
    {
        return $this->budget->amount;
    }

    /**
     * get budget spending
     *
     * @return int|float
     */
    public function getBudgetSpending()
    {
        return $this->budget->spending;
    }

    /**
     * get total spending value
     *
     * @return int|float
     */
    public function getTotalSpending()
    {
        return $this->totalSpending;
    }

    /**
     * get summary
     *
     * @return array
     */
    public function getSummary()
    {
        return $this->summary;
    }
}