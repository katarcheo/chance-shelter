<?php

namespace App\Domain\Report;;

use App\Domain\Money;
use App\Domain\Report\VO\OutcomesListToReport;
use App\Domain\Report\VO\Report;

class ReportService
{
    public static function getReport(Money $income, OutcomesListToReport $outcomes): Report
    {
//        calculation...
    }
}
