<?php

namespace App\Application\UseCases\RecordIncome;

readonly class IncomeDTO
{
    public function __construct(
        public float $amount,
        public int $fundId,
    )
    {}
}
