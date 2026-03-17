<?php

namespace App\Domain\Journal;

use App\Domain\Entity;
use App\Domain\Fund\Fund;
use App\Domain\Money;

final class Income extends Entity
{
    public function __construct(
        public Money $amount,
        public Fund $fund,
    )
    {
        $this->generateIdentity();
    }
}
