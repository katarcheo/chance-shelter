<?php

namespace App\Domain\Journal\Repository;

use App\Domain\DateRange;
use App\Domain\Journal\Journal;
use App\Domain\Money;

interface JournalRepository
{
    public function save(Journal $journal): void;
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseRecordList;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeRecordList;
    public function getCurrentBalance(): Money;
    public function lockCurrentBalance(): Journal;
}
