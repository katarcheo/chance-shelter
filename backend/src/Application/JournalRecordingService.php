<?php

namespace App\Application;

use App\Application\DTO\ExpenseDTO;
use App\Application\DTO\IncomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Fund\FundRepository;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Journal\Income;
use App\Domain\Journal\JournalRepository;
use App\Domain\Media;
use App\Domain\Money;

class JournalRecordingService
{
    public function __construct(
        private JournalRepository  $journalRepo,
        private FundRepository     $fundRepo,
        private CategoryRepository $categoryRepo,
        private string             $mediaDir,
    )
    {}

    public function income(IncomeDTO $incomeData): void
    {
        if (!$fund = $this->fundRepo->findById($incomeData->fundId)) {
            throw new ApplicationException("Fund not found");
        }

        $income = new Income(
            amount: Money::fromFloat($incomeData->amount),
            fund: $fund,
        );

        $balance = $this->journalRepo->lockCurrentBalance();
        $balance->applyIncome($income);

        $this->journalRepo->recordIncome($income, $balance);
    }

    public function expense(ExpenseDTO $expenseData): void
    {
        if (!$category = $this->categoryRepo->find($expenseData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        $expense = new Expense(
            amount: Money::fromFloat($expenseData->amount),
            category: $category,
            description: $expenseData->description,
        );

        foreach ($expenseData->media as $key => $file) {
            $file->move($this->mediaDir, "{$expense->id()}_$key.{$file->guessExtension()}");
        }
        $expense->addMedia(new Media(...$expenseData->media));

        $balance = $this->journalRepo->lockCurrentBalance();
        $balance->applyExpense($expense);

        $this->journalRepo->recordExpense($expense, $balance);
    }
}
