<?php

namespace App\Domain\Report;

use App\Support\TypedList;

readonly final class ReportExpensesList extends TypedList
{
    public function __construct(ReportExpense ...$list)
    {
        parent::__construct($list);
    }
}
