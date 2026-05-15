<?php

namespace App\Application\UseCases\RecordIncome;

readonly class CreateIncomeDTO
{
    public function __construct(
        public float $amount,
        public int $fundId,
    )
    {}
}
