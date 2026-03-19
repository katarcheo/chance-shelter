<?php

namespace App\Domain\Journal\Expense;

readonly class ExpenseMedia
{
    public function __construct(
        public string $path
    )
    {}
}
