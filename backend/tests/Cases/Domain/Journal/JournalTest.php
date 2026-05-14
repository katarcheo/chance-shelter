<?php

namespace Tests\Cases\Domain\Journal;

use App\Domain\Fund\Fund;
use App\Domain\Journal\Journal;
use App\Domain\Journal\BalanceLessThanExpenseException;
use App\Domain\Money;
use Tests\Factories\CategoryFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('domain')]
class JournalTest extends TestCase
{
    #[Test]
    public function applyIncome(): void
    {
        $fund = new Fund();
        $journal = new Journal(
            new Money(100),
        );

        $income = $journal->applyIncome(new Money(30), $fund);

        $this->assertEquals($fund, $income->getFund());
        $this->assertEquals(30, $income->getAmount()->getMinors());
        $this->assertEquals(130, $journal->getBalance()->getMinors());
    }

    #[Test]
    public function applyExpense(): void
    {
        $category = new CategoryFactory()->make();
        $description = 'test';
        $journal = new Journal(
            new Money(100),
        );

        $expense = $journal->applyExpense(new Money(30), $category, $description);

        $this->assertEquals(30, $expense->getAmount()->getMinors());
        $this->assertEquals($category, $expense->getCategory());
        $this->assertEquals(70, $journal->getBalance()->getMinors());
    }

    #[Test]
    public function applyExpenseException(): void
    {
        $journal = new Journal(
            new Money(100),
        );

        $this->expectException(BalanceLessThanExpenseException::class);
        $journal->applyExpense(new Money(101), new CategoryFactory()->make());
    }
}
