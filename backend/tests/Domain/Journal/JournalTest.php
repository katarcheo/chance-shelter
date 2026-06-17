<?php

use App\Domain\Fund\Fund;
use App\Domain\Journal\BalanceLessThanExpenseException;
use App\Domain\Money;
use App\Tests\Support\Mother\CategoryMother;
use App\Tests\Support\Mother\JournalMother;

pest()->group('domain');

test('apply income', function () {
    $fund = new Fund(name: 'test');
    $journal = JournalMother::withBalance(100);

    $income = $journal->applyIncome(new Money(30), $fund);

    expect($income->getFund())->toEqual($fund);
    expect($income->getAmount()->getMinors())->toEqual(30);
    expect($journal->getBalance()->getMinors())->toEqual(130);
});

test('apply expense', function () {
    $category = CategoryMother::make();
    $journal = JournalMother::withBalance(100);
    $description = 'test';

    $expense = $journal->applyExpense(new Money(30), $category, $description);

    expect($expense->getAmount()->getMinors())->toEqual(30);
    expect($expense->getCategory())->toEqual($category);
    expect($journal->getBalance()->getMinors())->toEqual(70);
});

test('apply expense exception', function () {
    $journal = JournalMother::withBalance(100);
    $category = CategoryMother::make();

    $this->expectException(BalanceLessThanExpenseException::class);
    $journal->applyExpense(new Money(101), $category);
});
