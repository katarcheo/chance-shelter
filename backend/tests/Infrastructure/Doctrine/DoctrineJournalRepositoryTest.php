<?php

use App\Domain\Journal\Repository\ExpenseRecord;
use App\Domain\Journal\Repository\ExpenseRecordList;
use App\Domain\Journal\Repository\JournalRepository;
use App\Tests\Support\HasRepositories;
use App\Tests\Support\Mother\ExpenseMother;
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
    $this->journalRepo->getExpensesByPeriod($range);
    $expected = new ExpenseRecordList(
        ExpenseMother::record(),
        ExpenseMother::record(),
        ExpenseMother::record(),
    );
    expect()
});
