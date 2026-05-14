<?php

namespace App\Domain\Report;

final readonly class ReportExpenseCategory
{
    public function __construct(
        public string $id,
        public string $name,
    )
    {}
}
