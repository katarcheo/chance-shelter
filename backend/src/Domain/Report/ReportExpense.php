<?php

namespace App\Domain\Report;;

use App\Domain\Category\Category;
use App\Domain\Ident;
use App\Domain\Money;

final readonly class ReportExpense
{
    public function __construct(
        public Ident $categoryId,
        public Money $amount,
    )
    {}
}
