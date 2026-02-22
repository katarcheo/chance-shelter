<?php

namespace App\Domain\ValueObject;

use Domain\ValueObject\Money;

final readonly class ReportOutcome
{
    public function __construct(
        public string $category,
        public Money $amount,
    )
    {}
}
