<?php

namespace App\Domain\Journal;

use App\Domain\Money;
use App\Infrastructure\TypedList;

readonly final class ExpenseList extends TypedList
{
    public function __construct(Expense ...$expenses)
    {
        parent::__construct($expenses);
    }

    public function sum(): Money
    {
        return array_reduce(
            $this->list,
            fn(Money $sum, Expense $expense) => $sum->add($expense->amount),
            new Money(0),
        );
    }
}