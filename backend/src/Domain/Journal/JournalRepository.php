<?php

namespace App\Domain\Journal;

use App\Domain\DateRange;
use App\Domain\Money;

interface JournalRepository
{
    public function save(Journal $journal): void;
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseListRecord;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeListRecord;
    public function getCurrentBalance(): Money;
    public function lockCurrentBalance(): Journal;
}
