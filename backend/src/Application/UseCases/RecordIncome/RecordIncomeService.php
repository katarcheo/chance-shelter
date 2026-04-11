<?php

namespace App\Application\UseCases\RecordIncome;

use App\Application\UseCases\Exceptions\ApplicationException;
use App\Domain\Fund\FundRepository;
use App\Domain\Journal\Income;
use App\Domain\Journal\JournalRepository;
use App\Domain\Money;

class RecordIncomeService
{
    public function __construct(
        private JournalRepository  $journalRepo,
        private FundRepository     $fundRepo,
    )
    {}

    public function handle(IncomeDTO $incomeData): void
    {
        if (!$fund = $this->fundRepo->findById($incomeData->fundId)) {
            throw new ApplicationException("Fund not found");
        }

        $income = new Income(
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
        );

        $balance = $this->journalRepo->lockCurrentBalance();
        $balance->applyIncome($income);

        $this->journalRepo->recordIncome($income, $balance);
    }
}
