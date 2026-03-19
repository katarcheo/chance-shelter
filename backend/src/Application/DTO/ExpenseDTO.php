<?php

namespace App\Application\DTO;

readonly class ExpenseDTO
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public int $categoryId,
        public Files $media,
    )
    {}
}