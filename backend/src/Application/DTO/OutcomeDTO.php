<?php

namespace App\Application\DTO;

readonly class OutcomeDTO
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public int $categoryId,
        public Files $media,
    )
    {}
}
