<?php

namespace App\Application\DTO;

use App\Domain\Money;

readonly class IncomeDTO
{
    public function __construct(
        public float $amount,
        public int $fundId,
    )
    {}
}
