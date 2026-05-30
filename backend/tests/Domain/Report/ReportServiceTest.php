<?php

use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\IncomeRecordList;
use App\Domain\Money;
use App\Domain\Report\ReportExpense;
use App\Domain\Report\ReportExpenseCategory;
use App\Domain\Report\ReportService;
use Tests\Support\Mother\CategoryMother;
use Tests\Support\Mother\ExpenseMother;
use Tests\Support\Mother\IncomeMother;

pest()->group('domain');

test('build', function () {
    $incomes = IncomeMother::listWithAmounts(100, 50, 200);

    $category1 = CategoryMother::make();
    $category2 = CategoryMother::make();

    $expenses = new ExpenseRecordList(
        ExpenseMother::record(150, $category1),
        ExpenseMother::record(10, $category2),
        ExpenseMother::record(20, $category2),
    );

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(350);
    expect($report->expense->getMinors())->toEqual(180);
    expect($report->rest->getMinors())->toEqual(170);
    expect($report->expenses)->toHaveCount(2);

    $this->assertContainsEquals(new ReportExpense(
        category: new ReportExpenseCategory(id: $category1->id(),  name: $category1->getName()),
        amount: new Money(150),
    ), $report->expenses);
    $this->assertContainsEquals(new ReportExpense(
        category: new ReportExpenseCategory(id: $category2->id(),  name: $category2->getName()),
        amount: new Money(30),
    ), $report->expenses);
});

test('build with empty incomes', function () {
    $incomes = new IncomeRecordList();

    $category1 = CategoryMother::make();
    $category2 = CategoryMother::make();

    $expenses = new ExpenseRecordList(
        ExpenseMother::record(150, $category1),
        ExpenseMother::record(10, $category2),
        ExpenseMother::record(20, $category2),
    );

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(0);
    expect($report->expense->getMinors())->toEqual(180);
    expect($report->rest->getMinors())->toEqual(-180);
    expect($report->expenses)->toHaveCount(2);

    $this->assertContainsEquals(new ReportExpense(
        category: new ReportExpenseCategory(id: $category1->id(),  name: $category1->getName()),
        amount: new Money(150),
    ), $report->expenses);
    $this->assertContainsEquals(new ReportExpense(
        category: new ReportExpenseCategory(id: $category2->id(),  name: $category2->getName()),
        amount: new Money(30),
    ), $report->expenses);
});

test('build with empty expenses', function () {
    $incomes = IncomeMother::listWithAmounts(100, 50, 200);

    $expenses = new ExpenseRecordList();

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(350);
    expect($report->expense->getMinors())->toEqual(0);
    expect($report->rest->getMinors())->toEqual(350);
    expect($report->expenses)->toHaveCount(0);
});

test('build with empty', function () {
    $incomes = new IncomeRecordList();
    $expenses = new ExpenseRecordList();

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(0);
    expect($report->expense->getMinors())->toEqual(0);
    expect($report->rest->getMinors())->toEqual(0);
    expect($report->expenses)->toHaveCount(0);
});
