<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Domain\Ident;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Money;

readonly class CreatedExpenseResult
{
    public function __construct(
        public Ident $id,
        public Money $amount,
        public Ident $categoryId,
        public string $categoryName,
    )
    {}

    public static function fromExpense(Expense $expense): self
    {
        return new self(
            id: $expense->id(),
            amount: $expense->getAmount(),
            categoryId: $expense->getCategory()->id(),
            categoryName: $expense->getCategory()->getName(),
        );
    }
}
