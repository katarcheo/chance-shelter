<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;

interface JournalRepository
{
    public function recordIncome(Income $income): void;
    public function recordOutcome(Outcome $outcome): void;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeList;
}
