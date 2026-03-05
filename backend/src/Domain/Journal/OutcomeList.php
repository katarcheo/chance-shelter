<?php

namespace App\Domain\Journal;

use App\Domain\Money;
use App\Infrastructure\TypedList;

readonly final class OutcomeList extends TypedList
{
    public function __construct(Outcome ...$outcomes)
    {
        parent::__construct($outcomes);
    }

    public function sum(): Money
    {
        return array_reduce(
            $this->list,
            fn(Money $sum, Outcome $outcome) => $sum->add($outcome->amount),
            new Money(0),
        );
    }
}
