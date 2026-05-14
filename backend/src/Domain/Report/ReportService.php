<?php

namespace App\Domain\Report;

use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\IncomeList;
use App\Domain\Money;

class ReportService
{
    public static function build(IncomeList $incomes, ExpenseList $expenses): Report
    {
        $amountByCategory = [];

        foreach ($expenses as $expense) {
            $id = $expense->getCategory()->id;

            if (!isset($amountByCategory[$id])) {
                $amountByCategory[$id] = [
                    'amount' => new Money(0),
                    'category' => $expense->getCategory(),
                ];
            }

            $amountByCategory[$id]['amount'] = $amountByCategory[$id]['amount']->add($expense->getAmount());
        }

        $expenseByCategory = [];

        foreach ($amountByCategory as $amount) {
            $expenseByCategory[] = new ReportExpense(
                category: new ReportExpenseCategory(
                    id: $amount['category']->id(),
                    name: $amount['category']->getName(),
                ),
                amount: $amount['amount'],
            );
        }
        $incomeSum = $incomes->sum();
        $expenseSum = $expenses->sum();

        return new Report(
            income: $incomeSum,
            expense: $expenseSum,
            rest: $incomeSum->subtract($expenseSum),
            expenses: new ReportExpensesList(...$expenseByCategory),
        );
    }
}
