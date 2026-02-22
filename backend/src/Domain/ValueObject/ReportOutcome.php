<?php

namespace App\Domain\ValueObject;

final readonly class ReportOutcome
{
    public function __construct(
        public string $category,
        public float $amount,
    )
    {}
}
