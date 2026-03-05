<?php

namespace App\Tests\Cases\Domain\Report;

use App\Domain\Journal\IncomeList;
use App\Domain\Journal\OutcomeList;
use App\Domain\Money;
use App\Domain\Report\Report;
use App\Domain\Report\ReportOutcome;
use App\Domain\Report\ReportOutcomesList;
use App\Domain\Report\ReportService;
use App\Tests\Factories\CategoryFactory;
use App\Tests\Factories\IncomeFactory;
use App\Tests\Factories\OutcomeFactory;
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

        $outcomes = new OutcomeList(
            new OutcomeFactory()->category($category1)->amount(150)->make(),
            new OutcomeFactory()->category($category2)->amount(10)->make(),
            new OutcomeFactory()->category($category2)->amount(20)->make(),
        );

        $report = ReportService::build($incomes, $outcomes);

        $this->assertEquals(350, $report->income->minors);
        $this->assertCount(2, $report->outcomes);
        $this->assertContainsEquals(new ReportOutcome(
            category: $category1,
            amount: new Money(150),
        ), $report->outcomes);
        $this->assertContainsEquals(new ReportOutcome(
            category: $category2,
            amount: new Money(30),
        ), $report->outcomes);
    }

    #[Test]
    public function buildWithEmptyIncomes()
    {
        $incomes = new IncomeList();

        $category1 = new CategoryFactory()->make();
        $category2 = new CategoryFactory()->make();

        $outcomes = new OutcomeList(
            new OutcomeFactory()->category($category1)->amount(150)->make(),
            new OutcomeFactory()->category($category2)->amount(10)->make(),
            new OutcomeFactory()->category($category2)->amount(20)->make(),
        );

        $report = ReportService::build($incomes, $outcomes);

        $this->assertEquals(0, $report->income->minors);
        $this->assertCount(2, $report->outcomes);
        $this->assertContainsEquals(new ReportOutcome(
            category: $category1,
            amount: new Money(150),
        ), $report->outcomes);
        $this->assertContainsEquals(new ReportOutcome(
            category: $category2,
            amount: new Money(30),
        ), $report->outcomes);
    }

    #[Test]
    public function buildWithEmptyOutcomes()
    {
        $incomes = new IncomeList(
            new IncomeFactory()->amount(100)->make(),
            new IncomeFactory()->amount(50)->make(),
            new IncomeFactory()->amount(200)->make(),
        );

        $outcomes = new OutcomeList();

        $report = ReportService::build($incomes, $outcomes);

        $this->assertEquals(350, $report->income->minors);
        $this->assertCount(0, $report->outcomes);
    }
}
