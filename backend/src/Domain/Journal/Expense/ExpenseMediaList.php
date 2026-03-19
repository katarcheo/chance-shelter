<?php

namespace App\Domain\Journal\Expense;

use App\Infrastructure\TypedList;

readonly class ExpenseMediaList extends TypedList
{
    public function __construct(ExpenseMedia ...$list)
    {
        parent::__construct($list);
    }
}
