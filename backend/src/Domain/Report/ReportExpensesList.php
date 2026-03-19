<?php

namespace App\Domain\Report;

use App\Infrastructure\TypedList;

readonly final class ReportExpensesList extends TypedList
{
    public function __construct(ReportExpense ...$list)
    {
        parent::__construct($list);
    }
}