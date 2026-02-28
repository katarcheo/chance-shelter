<?php

namespace App\Domain\Report\VO;;

use App\Domain\Category;
use App\Domain\Money;

final readonly class ReportOutcome
{
    public function __construct(
        public Category $category,
        public Money $amount,
    )
    {}
}
