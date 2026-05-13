<?php

namespace App\Tests\Cases\Domain\Journal;

use App\Domain\Journal\Journal;
use App\Domain\Journal\BalanceLessThanExpenseException;
use App\Domain\Money;
use App\Tests\Factories\ExpenseFactory;
use App\Tests\Factories\IncomeFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('domain')]
class BalanceTest extends TestCase
{
    #[Test]
    public function applyIncome(): void
    {
        $balance = new Journal(
            new Money(100),
        );
        $income = new IncomeFactory()->amount(30)->make();

        $balance->applyIncome($income);

        $this->assertEquals(130, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyExpense(): void
    {
        $balance = new Journal(
            new Money(100),
        );

        $expense = new ExpenseFactory()->amount(30)->make();
        $balance->applyExpense($expense);

        $this->assertEquals(70, $balance->getAmount()->minors);
    }

    #[Test]
    public function applyExpenseException(): void
    {
        $balance = new Journal(
            new Money(100),
        );

        $expense = new ExpenseFactory()->amount(101)->make();

        $this->expectException(BalanceLessThanExpenseException::class);
        $balance->applyExpense($expense);
    }
}
