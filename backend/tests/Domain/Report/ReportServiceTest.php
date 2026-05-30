<?php

use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\IncomeList;
use App\Domain\Money;
use App\Domain\Report\ReportExpense;
use App\Domain\Report\ReportExpenseCategory;
use App\Domain\Report\ReportService;
use Tests\Support\Factories\ExpenseFactory;
use Tests\Support\Factories\IncomeFactory;
use Tests\Support\Mother\CategoryMother;
use Tests\Support\Mother\IncomeMother;

pest()->group('domain');

test('build', function () {
    $incomes = IncomeMother::listWithAmounts();
    $incomes = new IncomeList(
        new IncomeFactory()->amount(100)->make(),
        new IncomeFactory()->amount(50)->make(),
        new IncomeFactory()->amount(200)->make(),
    );

    $category1 = CategoryMother::make();
    $category2 = CategoryMother::make();

    $expenses = new ExpenseList(
        new ExpenseFactory()->category($category1)->amount(150)->make(),
        new ExpenseFactory()->category($category2)->amount(10)->make(),
        new ExpenseFactory()->category($category2)->amount(20)->make(),
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
    $incomes = new IncomeList();

    $category1 = CategoryMother::make();
    $category2 = CategoryMother::make();

    $expenses = new ExpenseList(
        new ExpenseFactory()->category($category1)->amount(150)->make(),
        new ExpenseFactory()->category($category2)->amount(10)->make(),
        new ExpenseFactory()->category($category2)->amount(20)->make(),
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
    $incomes = new IncomeList(
        new IncomeFactory()->amount(100)->make(),
        new IncomeFactory()->amount(50)->make(),
        new IncomeFactory()->amount(200)->make(),
    );

    $expenses = new ExpenseList();

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(350);
    expect($report->expense->getMinors())->toEqual(0);
    expect($report->rest->getMinors())->toEqual(350);
    expect($report->expenses)->toHaveCount(0);
});

test('build with empty', function () {
    $incomes = new IncomeList();
    $expenses = new ExpenseList();

    $report = ReportService::build($incomes, $expenses);

    expect($report->income->getMinors())->toEqual(0);
    expect($report->expense->getMinors())->toEqual(0);
    expect($report->rest->getMinors())->toEqual(0);
    expect($report->expenses)->toHaveCount(0);
});
