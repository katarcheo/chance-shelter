<?php

namespace App\Domain\Journal;

class BalanceCalculationService
{
    public function byRecord(Outcome|Income $record, Balance $balance): Balance
    {
        return match ($record::class) {
            Outcome::class => $this->calculateBalanceByOutcome($record, $balance),
            Income::class => $this->calculateBalanceByIncome($record, $balance),
        };
    }

    private function calculateBalanceByOutcome(Outcome $outcome, Balance $balance): Balance
    {
        $result = $balance->amount->subtract($outcome->amount);

        if ($result->getMinors() < 0) {
            throw new OutcomeGreaterThanBalanceException();
        }

        return new Balance(amount: $result);
    }

    private function calculateBalanceByIncome(Income $outcome, Balance $balance): Balance
    {
        return new Balance(amount: $balance->amount->add($outcome->amount));
    }
}
