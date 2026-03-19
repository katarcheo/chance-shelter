<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;

interface JournalRepository
{
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseList;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeList;
    public function getCurrentBalance(): Balance;
    public function lockCurrentBalance(): Balance;
}