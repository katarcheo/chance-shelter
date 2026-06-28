<?php

use App\Domain\DateRange;
use App\Domain\Journal\Repository\ExpenseRecord;
use App\Domain\Journal\Repository\IncomeRecord;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use App\Tests\Support\Factories\Category\CategoryFactory;
use App\Tests\Support\Factories\Fund\FundFactory;
use App\Tests\Support\Factories\Journal\BalanceFactory;
use App\Tests\Support\HasRepositories;
use Carbon\CarbonImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

uses(
    KernelTestCase::class,
    HasRepositories::class
);

beforeEach(function () {
    $this::bootKernel();

    /* @var JournalRepository $repo */
    $repo = $this::getContainer()->get(JournalRepository::class);
    $this->journalRepo = $repo;
});

test('getExpensesByPeriod method mapping', function () {
    $now = CarbonImmutable::now();
    BalanceFactory::new(['balance' => new Money(1000)])
        ->withExpense(
            amount:      $amount = 100,
            category:    $category = CategoryFactory::new()->create(),
            description: $desc = 'test_desc',
            receivedAt:  $receivedAt = $now,
        )
        ->create();

    $expected = new ExpenseRecord(
        amount:       new Money($amount),
        categoryName: $category->getName(),
        categoryId:   $category->id,
        description:  $desc,
        receivedAt:   $receivedAt->startOfSecond(),
    );

    $range = new DateRange($now->subDay(), $now);
    $result = $this->journalRepo->getExpensesByPeriod($range);

    expect($result[0])->toEqual($expected);
});

test('getExpensesByPeriod method filtering', function () {
    $now = CarbonImmutable::now();

    BalanceFactory::new(['balance' => new Money(1500)])
        ->withExpense(amount: 100, receivedAt: $now)
        ->withExpense(amount: 200, receivedAt: $now->subDay())
        ->withExpense(amount: 300, receivedAt: $now->subDays(3))
        ->withExpense(amount: 400, receivedAt: $now->subDays(7))
        ->create();

    $range = new DateRange($now->subDays(4), $now->subDay());

    $result = $this->journalRepo->getExpensesByPeriod($range);
    $actualAmounts = $result->map(fn(ExpenseRecord $item) => $item->amount->getMinors());
    $expectedAmounts = [200, 300];

    expect($result)->toHaveCount(2);
    expect($actualAmounts)->toEqualCanonicalizing($expectedAmounts);
});

test('getIncomesByPeriod method mapping', function () {
    $now = CarbonImmutable::now();
    BalanceFactory::new(['balance' => new Money(1000)])
        ->withIncome(
            amount:     $amount = 100,
            fund:       $fund = FundFactory::new()->create(),
            receivedAt: $now,
        )
        ->create();

    $expected = new IncomeRecord(
        amount: new Money($amount),
        fundName: $fund->getName(),
        fundId: $fund->id,
        receivedAt: $now->startOfSecond(),
    );

    $range = new DateRange($now->subDay(), $now);

    $result = $this->journalRepo->getIncomesByPeriod($range);

    expect($result[0])->toEqual($expected);
});

test('getCurrentBalance method', function () {
    $amount = 125;

    BalanceFactory::new(['balance' => new Money($amount)])->create();

    $result = $this->journalRepo->getCurrentBalance();
    expect($result)->toEqual(new Money($amount));
});
