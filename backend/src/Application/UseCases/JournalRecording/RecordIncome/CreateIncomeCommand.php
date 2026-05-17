<?php

namespace App\Application\UseCases\JournalRecording\RecordIncome;

readonly class CreateIncomeCommand
{
    public function __construct(
        public float $amount,
        public int $fundId,
    )
    {}
}
