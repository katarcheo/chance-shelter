<?php

use App\Domain\DateRange;
use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use App\Tests\Support\Factories\Journal\JournalFactory;
use App\Tests\Support\HasRepositories;
use App\Tests\Support\Mother\ExpenseMother;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

uses(
    KernelTestCase::class,
    HasRepositories::class
);

beforeEach(function () {
    $this::bootKernel();

    /* @var JournalRepository $repo*/
    $repo = $this::getContainer()->get(JournalRepository::class);
    $this->journalRepo = $repo;
});

test('getExpensesByPeriod method', function () {
    $first = ExpenseMother::record(amount: 100, receivedAt: Carbon::now());
    $second = ExpenseMother::record(amount: 200, receivedAt: Carbon::yesterday());
    $third = ExpenseMother::record(amount: 300, receivedAt: Carbon::now()->subDays(3));
    $forth = ExpenseMother::record(amount: 300, receivedAt: Carbon::now()->subDays(7));

    JournalFactory::new(['balance' => new Money(1000)])
        ->withExpense(amount: $first->amount, receivedAt:  $first->receivedAt)
        ->withExpense(amount: $second->amount, receivedAt:  $second->receivedAt)
        ->withExpense(amount: $third->amount, receivedAt:  $third->receivedAt)
        ->withExpense(amount: $forth->amount, receivedAt:  $forth->receivedAt)
        ->create();

    $range = new DateRange(
        CarbonImmutable::now()->subDay(),
        CarbonImmutable::now()->subDays(4),
    );

    $expected = new ExpenseRecordList($second, $third);

    expect($this->journalRepo->getExpensesByPeriod($range))->toBe($expected);
});
