<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\DateRange;
use App\Domain\Journal\Journal;
use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\IncomeRecordList;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Doctrine\ORM\EntityRepository;

class DoctrineJournalRepository extends EntityRepository implements JournalRepository
{
    public function save(Journal $journal): void
    {
        $em = $this->getEntityManager();
        $em->persist($journal);
    }

    public function getExpensesByPeriod(DateRange $dateRange): ExpenseRecordList
    {
        // TODO: Implement getExpensesByPeriod() method.
    }

    public function getIncomesByPeriod(DateRange $dateRange): IncomeRecordList
    {
        // TODO: Implement getIncomesByPeriod() method.
    }

    public function getCurrentBalance(): Money
    {
        // TODO: Implement getCurrentBalance() method.
    }

    public function lockCurrentBalance(): Journal
    {
        // TODO: Implement lockCurrentBalance() method.
    }
}
