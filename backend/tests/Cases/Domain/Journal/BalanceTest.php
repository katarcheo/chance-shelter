<?php

namespace App\Tests\Cases\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\DomainId;
use App\Domain\Fund\Fund;
use App\Domain\Journal\Balance;
use App\Domain\Journal\Income;
use App\Domain\Journal\Outcome;
use App\Domain\Journal\OutcomeGreaterThanBalanceException;
use App\Domain\Medias;
use App\Domain\Money;
use App\Tests\Factories\IncomeFactory;
use App\Tests\Factories\OutcomeFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('domain')]
class BalanceTest extends TestCase
{
    #[Test]
    public function applyIncome(): void
    {
        $balance = new Balance(
            new Money(100),
        );
        $income = new IncomeFactory()->amount(30)->make();

        $balance->applyIncome($income);

        $this->assertEquals(130, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyOutcome(): void
    {
        $balance = new Balance(
            new Money(100),
        );

        $outcome = new OutcomeFactory()->amount(30)->make();
        $balance->applyOutcome($outcome);

        $this->assertEquals(70, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyOutcomeException(): void
    {
        $balance = new Balance(
            new Money(100),
        );

        $outcome = new OutcomeFactory()->amount(101)->make();

        $this->expectException(OutcomeGreaterThanBalanceException::class);
        $balance->applyOutcome($outcome);
    }
}
