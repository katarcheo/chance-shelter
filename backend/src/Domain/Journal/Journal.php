<?php

namespace App\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\Entity;
use App\Domain\Fund\Fund;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Money;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Journal extends Entity
{
    #[ORM\OneToMany(targetEntity: Income::class, mappedBy: 'journal')]
    private Collection $incomes;
    #[ORM\OneToMany(targetEntity: Expense::class, mappedBy: 'journal')]
    private Collection $expenses;

    public function __construct(
        #[ORM\Embedded]
        private Money $balance,
    )
    {
        $this->generateIdentity();
        $this->incomes = new ArrayCollection();
        $this->expenses = new ArrayCollection();
    }

    public function applyExpense(Money $amount, Category $category, ?string $description = null): Expense
    {
        $expense = new Expense(
            amount: $amount,
            category: $category,
            journal: $this,
            description: $description,
        );

        if ($amount->getMinors() > $this->balance->getMinors()) {
            throw new BalanceLessThanExpenseException();
        }

        $this->balance = $this->balance->subtract($amount);
        $this->expenses[] = $expense;

        return $expense;
    }

    public function applyIncome(Money $amount, Fund $fund): Income
    {
        $income = new Income($amount, $fund, $this);
        $this->incomes[] = $income;
        $this->balance = $this->balance->add($amount);

        return $income;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }
}
