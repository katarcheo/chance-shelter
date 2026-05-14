<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\DateRange;
use App\Domain\Journal\Journal;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\Income;
use App\Domain\Journal\IncomeList;
use App\Domain\Journal\JournalRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineJournalRepository extends DoctrineBaseRepository implements JournalRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YourEntity::class);
    }
    public function getExpensesByPeriod(DateRange $dateRange): ExpenseList
    {
//        ExpenseEntity::
    }

    public function recordIncome(Income $income, Journal $balance): void
    {
        $this->simpleSave($income);
        $this->simpleSave($balance);
    }

    public function recordExpense(Expense $expense, Journal $balance): void
    {
        $this->simpleSave($expense);
        $this->simpleSave($balance);
    }

    public function lockCurrentBalance(): Journal
    {
        // TODO: Implement lockCurrentBalance() method.
    }

    public function getIncomesByPeriod(DateRange $dateRange): IncomeList
    {
        // TODO: Implement getIncomesByPeriod() method.
    }

    public function getCurrentBalance(): Journal
    {
        // TODO: Implement getCurrentBalance() method.
    }

    public function save(Journal $journal): void
    {
        // TODO: Implement save() method.
    }
}
