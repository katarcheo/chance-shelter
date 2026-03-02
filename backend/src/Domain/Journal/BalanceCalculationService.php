<?php

namespace App\Domain\Journal;

class BalanceCalculationService
{
    public function calculateBalanceByOutcome(Outcome $outcome, Balance $balance): Balance
    {
        $result = $balance->amount->subtract($outcome->amount);

        if ($result->getMinors() < 0) {
            throw new OutcomeGreaterThanBalanceException();
        }

        return new Balance(amount: $result);
    }

    public function calculateBalanceByIncome(Income $outcome, Balance $balance): Balance
    {
        return new Balance(amount: $balance->amount->add($outcome->amount));
    }
}
