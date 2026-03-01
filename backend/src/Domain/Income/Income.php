<?php

namespace App\Domain\Income;

use App\Domain\DomainId;
use App\Domain\Fund\Fund;
use App\Domain\Money;

readonly final class Income
{
    public function __construct(
        public DomainId $id,
        public Money $amount,
        public Fund $fund,
    )
    {}
}
