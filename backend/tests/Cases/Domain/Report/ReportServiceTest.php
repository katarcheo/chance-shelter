<?php

use App\Domain\Journal\Expense\ExpenseList;
use App\Domain\Journal\IncomeList;
use App\Domain\Money;
use App\Domain\Report\ReportExpense;
use App\Domain\Report\ReportService;
use Tests\Factories\CategoryFactory;
use Tests\Factories\ExpenseFactory;
use Tests\Factories\IncomeFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

test('build', function () {
    $incomes = new IncomeList(
        new IncomeFactory()->amount(100)->make(),
        new IncomeFactory()->amount(50)->make(),
        new IncomeFactory()->amount(200)->make(),
    );

    $category1 = new CategoryFactory()->make();
    $category2 = new CategoryFactory()->make();

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
        category: $category1,
        amount: new Money(150),
    ), $report->expenses);
    $this->assertContainsEquals(new ReportExpense(
        category: $category2,
        amount: new Money(30),
    ), $report->expenses);
});

test('build with empty incomes', function () {
    $incomes = new IncomeList();

    $category1 = new CategoryFactory()->make();
    $category2 = new CategoryFactory()->make();

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
        category: $category1,
        amount: new Money(150),
    ), $report->expenses);
    $this->assertContainsEquals(new ReportExpense(
        category: $category2,
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
