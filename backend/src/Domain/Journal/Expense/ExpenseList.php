<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Money;
use App\Support\TypedList;

/**
 * @extends TypedList<Expense>
 */
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
            fn(Money $sum, Expense $expense) => $sum->add($expense->getAmount()),
            new Money(0),
        );
    }
}
