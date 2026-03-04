<?php

namespace App\Domain\Report;

use App\Infrastructure\TypedList;

readonly final class ReportOutcomesList extends TypedList
{
    public function __construct(ReportOutcome ...$list)
    {
        parent::__construct($list);
    }
}
