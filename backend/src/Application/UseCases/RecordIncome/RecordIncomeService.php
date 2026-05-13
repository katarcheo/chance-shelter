<?php

namespace App\Application\UseCases\RecordIncome;

use App\Application\Exceptions\ApplicationException;
use App\Domain\Fund\FundRepository;
use App\Domain\Journal\Income;
use App\Domain\Journal\JournalRepository;
use App\Domain\Money;
use Doctrine\ORM\EntityManager;

class RecordIncomeService
{
    public function __construct(
        private EntityManager     $em,
        private JournalRepository $journalRepo,
        private FundRepository    $fundRepo,
    )
    {}

    public function handle(IncomeDTO $incomeData): Income
    {
        if (!$fund = $this->fundRepo->findById($incomeData->fundId)) {
            throw new ApplicationException("Fund not found");
        }

        $journal = $this->journalRepo->lockCurrentBalance();
        $income = $journal->applyIncome(
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
        );

        $this->em->persist($journal);

        return $income;
    }
}
