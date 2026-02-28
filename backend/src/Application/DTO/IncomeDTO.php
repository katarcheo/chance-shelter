<?php

namespace App\Application\DTO;

readonly class IncomeDTO
{
    public function __construct(
        public float $amount,
        public int $fundId,
    )
    {}
}
