<?php

namespace App\Domain\Journal\Expense;

use App\Support\TypedList;

readonly class ExpenseMediaList extends TypedList
{
    public function __construct(ExpenseMedia ...$list)
    {
        parent::__construct($list);
    }
}
