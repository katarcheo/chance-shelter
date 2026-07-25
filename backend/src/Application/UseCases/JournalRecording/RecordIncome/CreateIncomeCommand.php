<?php

namespace App\Application\UseCases\JournalRecording\RecordIncome;

use App\Domain\Ident;

readonly class CreateIncomeCommand
{
    public function __construct(
        public float $amount,
        public Ident $fundId,
    )
    {}
}
