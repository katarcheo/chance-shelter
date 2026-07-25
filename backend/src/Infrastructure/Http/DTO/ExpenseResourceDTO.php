<?php

namespace App\Infrastructure\Http\DTO;

use App\Application\UseCases\JournalRecording\RecordExpense\CreatedExpenseResult;

class ExpenseResourceDTO extends ApiResponseDTO
{
    public function __construct(
        string $id,
    )
    {}

    public static  function from(CreatedExpenseResult $expense): self
    {
        return new self(
            id: $expense->id->toString(),
        );
    }
}
