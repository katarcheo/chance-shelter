<?php

namespace App\Application\ORMRepositories;

use App\Domain\DateRange;
use App\Domain\Journal\Balance;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\Income;
use App\Domain\Journal\IncomeList;
use App\Domain\Journal\JournalRepository;

class ORMJournalRepository extends ORMBaseRepository implements JournalRepository
{
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseList
    {
//        ExpenseEntity::
    }

    public function recordIncome(Income $income, Balance $balance): void
    {
        $this->simpleSave($income);
        $this->simpleSave($balance);
    }

    public function recordExpense(Expense $expense, Balance $balance): void
    {
        $this->simpleSave($expense);
        $this->simpleSave($balance);
    }

    public function lockCurrentBalance(): Balance
    {
        // TODO: Implement lockCurrentBalance() method.
    }

    public function getIncomesByPeriod(DateRange $dateRange): IncomeList
    {
        // TODO: Implement getIncomesByPeriod() method.
    }

    public function getCurrentBalance(): Balance
    {
        // TODO: Implement getCurrentBalance() method.
    }
}
