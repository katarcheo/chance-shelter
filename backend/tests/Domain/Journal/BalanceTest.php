<?php

namespace App\Tests\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\DomainId;
use App\Domain\Fund\Fund;
use App\Domain\Journal\Balance;
use App\Domain\Journal\Income;
use App\Domain\Journal\Outcome;
use App\Domain\Journal\OutcomeGreaterThanBalanceException;
use App\Domain\Medias;
use App\Domain\Money;
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
        $income = new Income(
            id: new DomainId('uuid1'),
            amount: new Money(30),
            fund: new Fund(),
        );

        $balance->applyIncome($income);

        $this->assertEquals(130, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyOutcome(): void
    {
        $balance = new Balance(
            new Money(100),
        );
        $outcome = new Outcome(
            id: new DomainId('uuid1'),
            amount: new Money(30),
            category: new Category(
                id: new DomainId('uuid1'),
                name: 'test_category',
            ),
            media: new Medias(),
        );

        $balance->applyOutcome($outcome);

        $this->assertEquals(70, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyOutcomeException(): void
    {
        $balance = new Balance(
            new Money(100),
        );
        $outcome = new Outcome(
            id: new DomainId('uuid1'),
            amount: new Money(101),
            category: new Category(
                id: new DomainId('uuid1'),
                name: 'test_category',
            ),
            media: new Medias(),
        );

        $this->expectException(OutcomeGreaterThanBalanceException::class);
        $balance->applyOutcome($outcome);
    }
}
