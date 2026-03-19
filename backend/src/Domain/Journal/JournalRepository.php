<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;

interface JournalRepository
{
    public function getOutcomesByPeriod(DateRange $dateRange): OutcomeList;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeList;
    public function getCurrentBalance(): Balance;
    public function lockCurrentBalance(): Balance;
}
