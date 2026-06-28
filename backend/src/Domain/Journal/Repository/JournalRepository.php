<?php

namespace App\Domain\Journal\Repository;

use App\Domain\DateRange;
use App\Domain\Journal\Balance;
use App\Domain\Money;

interface JournalRepository
{
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseRecordList;
    public function getIncomesByPeriod(DateRange $dateRange): IncomeRecordList;
    public function getCurrentBalance(): Money;
    public function getBalanceForUpdate(): Balance;
}
