<?php

namespace App\Infrastructure\Http\Resource;

use App\Application\UseCases\JournalRecording\RecordExpense\CreatedExpenseResult;

readonly class ExpenseResource extends Resource
{
    private function __construct(
        public string $id,
    )
    {}

    public static  function from(CreatedExpenseResult $expense): self
    {
        return new self(
            id: $expense->id->toString(),
        );
    }
}
