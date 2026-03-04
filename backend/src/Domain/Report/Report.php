<?php

namespace App\Domain\Report;

use App\Domain\Money;

final readonly class Report
{
    public function __construct(
        public Money $income,
        public ReportOutcomesList $outcomes,
    )
    {}
}
