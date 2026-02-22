<?php

namespace Domain\ValueObject;

final readonly class Report
{
    public function __construct(
        public string $title,
        public float $income,
        public ReportOutcomesList $outcomes,
    )
    {}


}
