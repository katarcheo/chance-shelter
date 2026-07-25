<?php

use App\Domain\Fund\Fund;
use App\Domain\Ident;
use App\Domain\Journal\BalanceLessThanExpenseException;
use App\Domain\Money;
use App\Tests\Support\Mother\CategoryMother;
use App\Tests\Support\Mother\BalanceMother;
use Carbon\CarbonImmutable;

test('apply income', function () {
    $fund = new Fund(Ident::new(), name: 'test');
    $balance = BalanceMother::amount(100);

    $income = $balance->applyIncome(new Money(30), $fund, CarbonImmutable::now());

    expect($income->getFund())->toEqual($fund);
    expect($income->getAmount()->getMinors())->toEqual(30);
    expect($balance->getAmount()->getMinors())->toEqual(130);
});

test('apply expense', function () {
    $category = CategoryMother::make();
    $balance = BalanceMother::amount(100);
    $description = 'test';

    $expense = $balance->applyExpense(new Money(30), $category, CarbonImmutable::now(), $description);

    expect($expense->getAmount()->getMinors())->toEqual(30);
    expect($expense->getCategory())->toEqual($category);
    expect($balance->getAmount()->getMinors())->toEqual(70);
});

test('apply expense exception', function () {
    $balance = BalanceMother::amount(100);
    $category = CategoryMother::make();

    $this->expectException(BalanceLessThanExpenseException::class);
    $balance->applyExpense(new Money(101), $category, CarbonImmutable::now());
});
