<?php

namespace App\Application\UseCases\RecordExpense;

use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Journal\Expense\ExpenseMedia;
use App\Domain\Journal\JournalRepository;
use App\Domain\Money;

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

        $journal = $this->journalRepo->lockCurrentBalance();

        $expense = $journal->applyExpense(
            amount: Money::fromFloat($expenseData->amount),
            category: $category,
            description: $expenseData->description,
        );

        foreach ($expenseData->media as $key => $file) {
            $file->move($this->mediaDir, "{$expense->id()}_$key.{$file->guessExtension()}");
            $expense->attachMedia(new ExpenseMedia($file->path));
        }

        $this->journalRepo->save($journal);
        
        return CreatedExpenseResult::fromExpense($expense);
    }
}
