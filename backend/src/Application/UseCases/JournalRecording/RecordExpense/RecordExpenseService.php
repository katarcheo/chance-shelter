<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Expense\ExpenseMedia;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Carbon\CarbonImmutable;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\String\ByteString;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class RecordExpenseService
{
    public function __construct(
        private JournalRepository  $journalRepo,
        private CategoryRepository $categoryRepo,
        private FilesystemOperator $mediaStorage,
    )
    {}

    public function __invoke(CreateExpenseCommand $expenseData): CreatedExpenseResult
    {
        if (!$category = $this->categoryRepo->find($expenseData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        $balance = $this->journalRepo->getBalanceForUpdate();

        $expense = $balance->applyExpense(
            amount: Money::fromFloat($expenseData->amount),
            category: $category,
            receivedAt: CarbonImmutable::now(),
            description: $expenseData->description,
        );

        foreach ($expenseData->media as $file) {
            $key = ByteString::fromRandom(7);
            $filename = "{$expense->id()}_$key.{$file->guessExtension()}";

            $this->mediaStorage->writeStream($filename, fopen($file->getPathname(), 'rb'));
            $expense->attachMedia(new ExpenseMedia($filename));
        }

        return CreatedExpenseResult::fromExpense($expense);
    }
}
