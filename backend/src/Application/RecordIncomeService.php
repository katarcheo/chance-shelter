<?php

namespace App\Application;

use App\Application\DTO\IncomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Income\Income;
use App\Domain\Money;
use App\Domain\Repository\FundRepository;
use App\Domain\Repository\JournalRepository;

class RecordIncomeService
{
    public function __construct(
        private JournalRepository $journalRepository,
        private FundRepository $fundRepository,
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

        $this->journalRepository->recordIncome($income);
    }
}
