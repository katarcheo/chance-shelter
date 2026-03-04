<?php

namespace App\Tests\Cases\Domain\Report;

use App\Domain\Journal\IncomeList;
use App\Domain\Journal\OutcomeList;
use App\Domain\Money;
use App\Domain\Report\Report;
use App\Domain\Report\ReportOutcome;
use App\Domain\Report\ReportOutcomesList;
use App\Domain\Report\ReportService;
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

        $outcomes = new OutcomeList(
            $outcome1 = new OutcomeFactory()->category('test1')->amount(150)->make(),
            $outcome2 = new OutcomeFactory()->category('test2')->amount(10)->make(),
            new OutcomeFactory()->category('test2')->amount(20)->make(),
        );

        $report = ReportService::build($incomes, $outcomes);
        $expected = [
            new ReportOutcome(
                category: $outcome1->category,
                amount: new Money(150),
            ),
            new ReportOutcome(
                category: $outcome2->category,
                amount: new Money(30),
            ),
        ];

        $this->assertObjectEquals(new Report(
            income: new Money(350),
            outcomes: new ReportOutcomesList(...$expected),
        ), $report);
    }
}
