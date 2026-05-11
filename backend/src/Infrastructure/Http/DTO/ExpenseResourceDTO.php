<?php

namespace App\Infrastructure\Http\DTO;

use App\Domain\Journal\Expense\Expense;

class ExpenseResourceDTO extends ApiResponseDTO
{
    public function __construct(
        string $id,
    )
    {}

    public static  function from(Expense $expense): self
    {
        return new self(
            id: $expense->id,
        );
    }
}
