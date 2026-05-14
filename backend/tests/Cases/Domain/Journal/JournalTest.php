<?php

use App\Domain\Fund\Fund;
use App\Domain\Journal\Journal;
use App\Domain\Journal\BalanceLessThanExpenseException;
use App\Domain\Money;
use Tests\Factories\CategoryFactory;

pest()->group('domain');

test('apply income', function () {
    $fund = new Fund();
    $journal = new Journal(
        new Money(100),
    );

    $income = $journal->applyIncome(new Money(30), $fund);

    expect($income->getFund())->toEqual($fund);
    expect($income->getAmount()->getMinors())->toEqual(30);
    expect($journal->getBalance()->getMinors())->toEqual(130);
});

test('apply expense', function () {
    $category = new CategoryFactory()->make();
    $description = 'test';
    $journal = new Journal(
        new Money(100),
    );

    $expense = $journal->applyExpense(new Money(30), $category, $description);

    expect($expense->getAmount()->getMinors())->toEqual(30);
    expect($expense->getCategory())->toEqual($category);
    expect($journal->getBalance()->getMinors())->toEqual(70);
});

test('apply expense exception', function () {
    $journal = new Journal(
        new Money(100),
    );

    $this->expectException(BalanceLessThanExpenseException::class);
    $journal->applyExpense(new Money(101), new CategoryFactory()->make());
});
