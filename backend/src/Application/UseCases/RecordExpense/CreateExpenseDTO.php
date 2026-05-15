<?php

namespace App\Application\UseCases\RecordExpense;

readonly class CreateExpenseDTO
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public int $categoryId,
        public FilesList $media,
    )
    {}
}
