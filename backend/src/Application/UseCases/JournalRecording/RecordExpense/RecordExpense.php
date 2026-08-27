<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class RecordExpense
{
    public function __construct(
        private JournalRepository  $journalRepo,
        private CategoryRepository $categoryRepo,
    )
    {}

    public function __invoke(CreateExpenseCommand $expenseData): CreatedExpenseResult
    {
        if (!$category = $this->categoryRepo->find($expenseData->categoryId)) {
            throw new CategoryNotFoundException();
        }

        $balance = $this->journalRepo->getBalanceForUpdate();

        $expense = $balance->applyExpense(
            amount: Money::fromFloat($expenseData->amount),
            category: $category,
            receivedAt: $expenseData->createdAt,
            description: $expenseData->description,
        );

        foreach ($expenseData->attachments as $attachment) {
            $expense->attachMedia($attachment);
        }

        return CreatedExpenseResult::fromExpense($expense);
    }
}
