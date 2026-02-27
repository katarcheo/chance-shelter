<?php

namespace App\Domain\Income;

use App\Domain\Fund;
use App\Domain\Money;

final readonly class NewIncome
{
    public function __construct(
        public Money $amount,
        public Fund $fund,
    )
    {}
}
