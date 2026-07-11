<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Expense\ExpenseMedia;
use App\Domain\Journal\Repository\JournalRepository;
use App\Domain\Money;
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
        dd($expenseData);
//        if (!$category = $this->categoryRepo->find($expenseData->categoryId)) {
//            throw new ApplicationException("Category not found");
//        }
//
//        $balance = $this->journalRepo->lockCurrentBalance();
//
//        $expense = $balance->applyExpense(
//            amount: Money::fromFloat($expenseData->amount),
//            category: $category,
//            description: $expenseData->description,
//        );
//
//        foreach ($expenseData->media as $key => $file) {
//            $file->move($this->mediaDir, "{$expense->id()}_$key.{$file->guessExtension()}");
//            $expense->attachMedia(new ExpenseMedia($file->path));
//        }
//
//        $this->journalRepo->save($balance);
        return CreatedExpenseResult::fromExpense($expense);
    }
}
