<?php

namespace App\Domain;

use Domain\ValueObject\Money;
use Domain\ValueObject\OutcomesListToReport;
use Domain\ValueObject\Report;

class Reporter
{
    public static function getReport(Money $income, OutcomesListToReport $outcomes): Report
    {
//        calculation...
    }
}
