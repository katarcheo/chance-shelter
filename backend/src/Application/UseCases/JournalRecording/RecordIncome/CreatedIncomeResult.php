<?php

namespace App\Application\UseCases\JournalRecording\RecordIncome;

use App\Domain\Ident;
use App\Domain\Journal\Income;
use App\Domain\Money;

readonly class CreatedIncomeResult
{
    public function __construct(
        public Ident $id,
        public Money  $amount,
        public Ident $fundId,
        public string $fundName,
    )
    {
    }

    public static function fromIncome(Income $income): self
    {
        return new self(
            id: $income->id(),
            amount: $income->getAmount(),
            fundId: $income->getFund()->id(),
            fundName: $income->getFund()->getName(),
        );
    }
}
