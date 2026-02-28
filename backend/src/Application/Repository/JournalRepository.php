<?php

namespace App\Application\Repository;

use App\Domain\DateRange;
use App\Domain\Income\Income;
use App\Domain\Income\IncomeList;
use App\Domain\Outcome\Outcome;

class JournalRepository
{

    public function recordIncome(Income $income): void
    {
    }

    public function recordOutcome(Outcome $outcome): void
    {
    }

    public function getIncomesByPeriod(DateRange $dateRange): IncomeList
    {
    }
}
