<?php

namespace App\Application;

use App\Application\DTO\IncomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Fund\FundRepository;
use App\Domain\Journal\BalanceCalculationService;
use App\Domain\Journal\Income;
use App\Domain\Journal\JournalRepository;
use App\Domain\Money;

class RecordIncomeService
{
    public function __construct(
        private JournalRepository         $journalRepository,
        private FundRepository            $fundRepository,
        private BalanceCalculationService $balanceService,
    )
    {}

    public function record(IncomeDTO $incomeData): void
    {
        if (!$fund = $this->fundRepository->findById($incomeData->fundId)) {
            throw new ApplicationException("Fund not found");
        }

        $income = new Income(
            id: Uuid::generate(),
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
        );

        $newBalance = $this->balanceService->byRecord(
            $income,
            $this->journalRepository->getCurrentBalance(),
        );

        $this->journalRepository->recordIncome($income, $newBalance);
    }
}
