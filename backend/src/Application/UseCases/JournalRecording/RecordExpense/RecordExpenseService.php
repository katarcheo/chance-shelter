<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Expense\ExpenseMedia;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class RecordExpenseService
{
    public function __construct(
        private JournalRepository  $journalRepo,
        private CategoryRepository $categoryRepo,
        private string             $mediaDir,
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

        foreach ($expenseData->media as $key => $file) {
            $file->move($this->mediaDir, "{$expense->id()}_$key.{$file->guessExtension()}");
            $expense->attachMedia(new ExpenseMedia($file->path));
        }

        return CreatedExpenseResult::fromExpense($expense);
    }
}
