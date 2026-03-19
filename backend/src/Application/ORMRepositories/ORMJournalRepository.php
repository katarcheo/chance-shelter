<?php

namespace App\Application\ORMRepositories;

use App\Domain\DateRange;
use App\Domain\Journal\Balance;
use App\Domain\Journal\Income;
use App\Domain\Journal\JournalRepository;
use App\Domain\Journal\Outcome;
use App\Domain\Journal\OutcomeList;

class ORMJournalRepository extends ORMBaseRepository implements JournalRepository
{
    public function getOutcomesByPeriod(DateRange $dateRange): OutcomeList
    {
//        OutcomeEntity::
    }

    public function recordIncome(Income $income, Balance $balance): void
    {
        $this->simpleSave($income);
        $this->simpleSave($balance);
    }

    public function recordOutcome(Outcome $outcome, Balance $balance): void
    {
        $this->simpleSave($outcome);
        $this->simpleSave($balance);
    }

    public function lockCurrentBalance(): Balance
    {
        // TODO: Implement lockCurrentBalance() method.
    }
}
