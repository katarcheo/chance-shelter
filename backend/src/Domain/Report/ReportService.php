<?php

namespace App\Domain\Report;

use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\IncomeRecordList;
use App\Domain\Money;

class ReportService
{
    public static function build(IncomeRecordList $incomes, ExpenseRecordList $expenses): Report
    {
        $amountByCategory = [];
        $categories = [];

        foreach ($expenses as $expense) {
            $id = $expense->categoryId;

            if (!isset($categories[$id])) {
                $categories[$id] = new ReportExpenseCategory(
                    id: $id,
                    name: $expense->categoryName,
                );
                $amountByCategory[$id] = $expense->amount;
            } else {
                $amountByCategory[$id] = $amountByCategory[$id]->add($expense->amount);
            }
        }

        $expenseByCategory = [];

        foreach ($amountByCategory as $id => $amount) {
            $expenseByCategory[] = new ReportExpense(
                category: $categories[$id],
                amount: $amount,
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
