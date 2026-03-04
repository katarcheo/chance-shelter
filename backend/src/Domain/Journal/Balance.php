<?php

namespace App\Domain\Journal;

use App\Domain\Money;

final class Balance
{
    public function __construct(
        private Money $amount,
    )
    {}

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function applyOutcome(Outcome $outcome): self
    {
        if ($outcome->amount->minors > $this->amount->minors) {
            throw new OutcomeGreaterThanBalanceException();
        }

        $this->amount = $this->amount->subtract($outcome->amount);

        return $this;
    }

    public function applyIncome(Income $outcome): self
    {
        $this->amount = $this->amount->add($outcome->amount);

        return $this;
    }
}
