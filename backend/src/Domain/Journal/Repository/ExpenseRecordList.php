<?php

namespace App\Domain\Journal\Repository;

use App\Domain\Money;
use App\Support\TypedList;

/**
 * @extends TypedList<ExpenseRecord>
 */
final readonly class ExpenseRecordList extends TypedList
{
    public function __construct(ExpenseRecord ...$items)
    {
        parent::__construct($items);
    }

    public function sum(): Money
    {
        return array_reduce(
            $this->list,
            fn(Money $sum, ExpenseRecord $income) => $sum->add($income->amount),
            new Money(0),
        );
    }
}
