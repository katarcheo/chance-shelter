<?php

namespace App\Domain\Journal;

class OutcomeAvailabilityService
{
    public function check(Outcome $outcome, Balance $balance): void
    {
        if ($outcome->amount > $balance->amount) {
            throw new OutcomeGreaterThanBalanceException();
        }
    }
}
