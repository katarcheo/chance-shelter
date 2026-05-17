<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\DateRange;
use App\Domain\Journal\IncomeList;
use App\Domain\Journal\Journal;
use App\Domain\Journal\Repository\JournalRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineJournalRepository extends EntityRepository implements JournalRepository
{
    public function getExpensesByPeriod(DateRange $dateRange):
    {
//        ExpenseEntity::
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
        $em = $this->getEntityManager();
        $em->persist($journal);
    }
}
