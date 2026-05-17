<?php

namespace App\Domain\Journal\Repository;

use App\Support\TypedList;

final readonly class ExpenseRecordList extends TypedList
{
    public function __construct(ExpenseRecord ...$items)
    {
        parent::__construct($items);
    }
}
