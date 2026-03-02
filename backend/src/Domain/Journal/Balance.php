<?php

namespace App\Domain\Journal;

use App\Domain\Money;

readonly final class Balance
{
    public function __construct(
        public Money $amount,
    )
    {}
}
