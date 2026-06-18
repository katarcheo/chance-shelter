<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Category\Category;
use App\Domain\DateRange;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Journal\Income;
use App\Domain\Journal\Journal;
use App\Domain\Journal\Repository\ExpenseRecord;
use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\IncomeRecord;
use App\Domain\Journal\Repository\IncomeRecordList;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineJournalRepository extends ServiceEntityRepository implements JournalRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Journal::class);
    }

    public function save(Journal $journal): void
    {
        $em = $this->getEntityManager();
        $em->persist($journal);
    }

    public function getExpensesByPeriod(DateRange $dateRange): ExpenseRecordList
    {
        $result = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->from(Expense::class, 'e')
            ->select('e', 'c')
            ->join('e.category', 'c')
            ->where('e.receivedAt > :from')
            ->andWhere('e.receivedAt <= :to')
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->getQuery()
            ->getArrayResult();

        $result = array_map(fn(array $record) => new ExpenseRecord(
            amount:       new Money($record['amount.minors'], $record['amount.currency']),
            categoryName: $record['category']['name'],
            categoryId:   $record['category']['id'],
            description:  $record['description'],
            receivedAt:   $record['receivedAt'],
        ), $result);

        return new ExpenseRecordList(...$result);
    }

    public function getIncomesByPeriod(DateRange $dateRange): IncomeRecordList
    {
        $result = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->from(Income::class, 'i')
            ->select('i', 'f')
            ->join('i.fund', 'f')
            ->where('i.receivedAt > :from')
            ->andWhere('i.receivedAt <= :to')
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->getQuery()
            ->getArrayResult();

        $result = array_map(fn(array $record) => new IncomeRecord(
            amount: new Money($record['amount.minors'], $record['amount.currency']),
            fundName: $record['fund']['name'],
            fundId: $record['fund']['id'],
            receivedAt: $record['receivedAt'],
        ), $result);

        return new IncomeRecordList(...$result);
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
