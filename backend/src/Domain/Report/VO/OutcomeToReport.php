<?php

namespace App\Domain\Report\VO;;

use App\Domain\Money;

final readonly class OutcomeToReport
{
    public function __construct(
        public Money $amount,
        public string $category,
        public \DateTime $date,
    )
    {}
}
