<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;
use App\Domain\Journal\Expense\ExpenseList;

interface JournalRepository
{
    public function save(Journal $journal): void;
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseList;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeList;
    public function getCurrentBalance(): Journal;
    public function lockCurrentBalance(): Journal;
}
