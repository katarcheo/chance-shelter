<?php

namespace App\Application\UseCases\JournalRecording\RecordIncome;

use App\Domain\Fund\FundRepository;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Carbon\CarbonImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class RecordIncome
{
    public function __construct(
        private JournalRepository $journalRepo,
        private FundRepository    $fundRepo,
    )
    {}

    public function __invoke(CreateIncomeCommand $incomeData): CreatedIncomeResult
    {
        if (!$fund = $this->fundRepo->find($incomeData->fundId)) {
            throw new FundNotFoundException();
        }

        $balance = $this->journalRepo->getBalanceForUpdate();
        $income = $balance->applyIncome(
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
            receivedAt: CarbonImmutable::now(),
        );

        return CreatedIncomeResult::fromIncome($income);
    }
}
