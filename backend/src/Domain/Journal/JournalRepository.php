<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;

interface JournalRepository
{
    public function recordIncome(Income $income, Balance $balance): void;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeList;
    public function getCurrentBalance(): Balance;
    public function lockCurrentBalance(): Balance;
}
