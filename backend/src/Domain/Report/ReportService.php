<?php

namespace App\Domain\Report;

use App\Domain\Ident;
use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\IncomeRecordList;

class ReportService
{
    public static function build(IncomeRecordList $incomes, ExpenseRecordList $expenses): Report
    {
        $amountByCategory = [];
        foreach ($expenses as $expense) {
            $id = $expense->categoryId->toString();
            if (isset($amountByCategory[$id])) {
                $amountByCategory[$id] = $expense->amount->add($amountByCategory[$id]);
            } else {
                $amountByCategory[$id] = $expense->amount;
            }
        }

        $expenseByCategory = [];

        foreach ($amountByCategory as $id => $amount) {
            $expenseByCategory[] = new ReportExpense(
                categoryId: Ident::from($id),
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
