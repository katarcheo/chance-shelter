<?php

namespace App\Domain\Journal;

use App\Domain\Entity;
use App\Domain\Money;

final class Balance extends Entity
{
    public function __construct(
        private Money $amount,
    )
    {
        $this->generateIdentity();
    }

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
