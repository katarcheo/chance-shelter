<?php

namespace App\Domain\Journal\Repository;

use App\Domain\Money;
use App\Support\TypedList;

/**
 * @extends TypedList<IncomeRecord>
 */
final readonly class IncomeRecordList extends TypedList
{
    public function __construct(IncomeRecord ...$items)
    {
        parent::__construct($items);
    }

    public function sum(): Money
    {
        return array_reduce(
            $this->list,
            fn(Money $sum, IncomeRecord $income) => $sum->add($income->amount),
            new Money(0),
        );
    }
}
