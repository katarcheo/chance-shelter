<?php

namespace App\Domain;

use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\OutcomesListToReport;
use App\Domain\ValueObject\Report;

class Reporter
{
    public static function getReport(Money $income, OutcomesListToReport $outcomes): Report
    {
//        calculation...
    }
}
