<?php

namespace App\Domain\Journal;

use App\Domain\Money;
use App\Infrastructure\Support\TypedList;

final readonly class IncomeList extends TypedList
{
    public function __construct(Income ...$income)
    {
        parent::__construct($income);
    }

    public function sum(): Money
    {
        return array_reduce(
            $this->list,
            fn(Money $sum, Income $income) => $sum->add($income->amount),
            new Money(0),
        );
    }
}
