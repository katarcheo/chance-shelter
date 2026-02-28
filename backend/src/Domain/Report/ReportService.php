<?php

namespace App\Domain\Report;;

use App\Domain\Money;
use App\Domain\Report\VO\OutcomesListToReport;
use App\Domain\Report\VO\Report;
use App\Domain\Report\VO\ReportOutcome;
use App\Domain\Report\VO\ReportOutcomesList;

class ReportService
{
    public static function getReport(string $title, Money $income, OutcomesListToReport $outcomes): Report
    {
        $amountByCategory = [];

        foreach ($outcomes as $outcome) {
            $id = $outcome->category->id;

            if (isset($amountByCategory[$id])) {
                $amountByCategory[$id] = [
                    'amount' => new Money(0),
                    'category' => $outcome->category,
                ];
            }

            $amountByCategory[$id]['amount'] = $amountByCategory[$id]['amount']->add($outcome->amount);
        }

        $outcomeByCategory = [];

        foreach ($amountByCategory as $amount) {
            $outcomeByCategory[] = new ReportOutcome(
                category: $amount['category'],
                amount: $amount['amount'],
            );
        }

        return new Report(
            title: $title,
            income: $income->toFloat(),
            outcomes: new ReportOutcomesList(...$outcomeByCategory),
        );
    }
}
