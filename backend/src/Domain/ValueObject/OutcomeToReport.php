<?php

namespace Domain\ValueObject;
final readonly class OutcomeToReport
{
    public function __construct(
        public float $amount,
        public string $category,
        public \DateTime $date,
    )
    {}
}
