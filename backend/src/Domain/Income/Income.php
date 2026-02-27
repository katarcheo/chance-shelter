<?php

namespace App\Domain\Income;

use App\Domain\Fund;
use App\Domain\Money;

readonly final class Income
{
    public function __construct(
        public int $id,
        public Money $amount,
        public Fund $fund,
    )
    {}
}
