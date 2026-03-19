<?php

namespace App\Tests\Cases\Domain\Report;

use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\IncomeList;
use App\Domain\Money;
use App\Domain\Report\ReportExpense;
use App\Domain\Report\ReportService;
use App\Tests\Factories\CategoryFactory;
use App\Tests\Factories\ExpenseFactory;
use App\Tests\Factories\IncomeFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('domain')]
class ReportServiceTest extends TestCase
{
    #[Test]
    public function build(): void
    {
        $incomes = new IncomeList(
            new IncomeFactory()->amount(100)->make(),
            new IncomeFactory()->amount(50)->make(),
            new IncomeFactory()->amount(200)->make(),
        );

        $category1 = new CategoryFactory()->make();
        $category2 = new CategoryFactory()->make();

        $expenses = new ExpenseList(
            new ExpenseFactory()->category($category1)->amount(150)->make(),
            new ExpenseFactory()->category($category2)->amount(10)->make(),
            new ExpenseFactory()->category($category2)->amount(20)->make(),
        );

        $report = ReportService::build($incomes, $expenses);

        $this->assertEquals(350, $report->income->minors);
        $this->assertEquals(180, $report->expense->minors);
        $this->assertEquals(170, $report->rest->minors);
        $this->assertCount(2, $report->expenses);
        $this->assertContainsEquals(new ReportExpense(
            category: $category1,
            amount: new Money(150),
        ), $report->expenses);
        $this->assertContainsEquals(new ReportExpense(
            category: $category2,
            amount: new Money(30),
        ), $report->expenses);
    }

    #[Test]
    public function buildWithEmptyIncomes()
    {
        $incomes = new IncomeList();

        $category1 = new CategoryFactory()->make();
        $category2 = new CategoryFactory()->make();

        $expenses = new ExpenseList(
            new ExpenseFactory()->category($category1)->amount(150)->make(),
            new ExpenseFactory()->category($category2)->amount(10)->make(),
            new ExpenseFactory()->category($category2)->amount(20)->make(),
        );

        $report = ReportService::build($incomes, $expenses);

        $this->assertEquals(0, $report->income->minors);
        $this->assertEquals(180, $report->expense->minors);
        $this->assertEquals(-180, $report->rest->minors);
        $this->assertCount(2, $report->expenses);
        $this->assertContainsEquals(new ReportExpense(
            category: $category1,
            amount: new Money(150),
        ), $report->expenses);
        $this->assertContainsEquals(new ReportExpense(
            category: $category2,
            amount: new Money(30),
        ), $report->expenses);
    }

    #[Test]
    public function buildWithEmptyExpenses()
    {
        $incomes = new IncomeList(
            new IncomeFactory()->amount(100)->make(),
            new IncomeFactory()->amount(50)->make(),
            new IncomeFactory()->amount(200)->make(),
        );

        $expenses = new ExpenseList();

        $report = ReportService::build($incomes, $expenses);

        $this->assertEquals(350, $report->income->minors);
        $this->assertEquals(0, $report->expense->minors);
        $this->assertEquals(350, $report->rest->minors);
        $this->assertCount(0, $report->expenses);
    }

    #[Test]
    public function buildWithEmpty()
    {
        $incomes = new IncomeList();

        $expenses = new ExpenseList();

        $report = ReportService::build($incomes, $expenses);

        $this->assertEquals(0, $report->income->minors);
        $this->assertEquals(0, $report->expense->minors);
        $this->assertEquals(0, $report->rest->minors);
        $this->assertCount(0, $report->expenses);
    }
}
