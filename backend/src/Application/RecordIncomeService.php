<?php

namespace App\Application;

use App\Application\DTO\IncomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Application\Repository\FundRepository;
use App\Application\Repository\JournalRepository;
use App\Domain\Income\NewIncome;
use App\Domain\Money;

class RecordIncomeService
{
    public function __construct(
        private JournalRepository $journalRepository,
        private FundRepository $fundRepository,
    )
    {}

    public function record(IncomeDTO $incomeData): void
    {
        $fund = $this->fundRepository->findById($incomeData->fundId);

        if (!$fund) {
            throw new ApplicationException("Fund not found");
        }

        $income = new NewIncome(
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
        );

        $this->journalRepository->recordIncome($income);
    }
}
