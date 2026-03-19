<?php

namespace App\Domain\Report;;

use App\Domain\Category\Category;
use App\Domain\Money;

final readonly class ReportExpense
{
    public function __construct(
        public Category $category,
        public Money $amount,
    )
    {}
}