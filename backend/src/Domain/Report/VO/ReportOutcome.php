<?php

namespace App\Domain\Report\VO;;

use App\Domain\Money;

final readonly class ReportOutcome
{
    public function __construct(
        public string $category,
        public Money $amount,
    )
    {}
}
