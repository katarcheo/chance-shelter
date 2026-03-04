<?php

namespace App\Tests\Cases\Domain\Report;

use App\Domain\Journal\Income;
use App\Domain\Journal\IncomeList;
use App\Domain\Journal\OutcomeList;
use App\Domain\Report\ReportService;
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
            new Income(),
            new Income(),
        );
        $outcomes = new OutcomeList();
        ReportService::build($incomes, $outcomes);
    }
}
