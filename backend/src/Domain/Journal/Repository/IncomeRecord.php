<?php

namespace App\Domain\Journal\Repository;

use App\Domain\Money;

final readonly class IncomeRecord
{
    public function __construct(
        public Money  $amount,
        public string $fundName,
        public string $fundId,
    )
    {}
}
