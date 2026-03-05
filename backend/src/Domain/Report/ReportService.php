<?php

namespace App\Domain\Report;

use App\Domain\Journal\IncomeList;
use App\Domain\Journal\OutcomeList;
use App\Domain\Money;

class ReportService
{
    public static function build(IncomeList $incomes, OutcomeList $outcomes): Report
    {
        $amountByCategory = [];

        foreach ($outcomes as $outcome) {
            $id = (string) $outcome->category->id;

            if (!isset($amountByCategory[$id])) {
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
        $incomeSum = $incomes->sum();
        $outcomeSum = $outcomes->sum();

        return new Report(
            income: $incomeSum,
            outcome: $outcomeSum,
            rest: $incomeSum->subtract($outcomeSum),
            outcomes: new ReportOutcomesList(...$outcomeByCategory),
        );
    }
}
