<?php

namespace App\Domain\Journal;

use App\Domain\Entity;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Money;

final class Balance extends Entity
{
    public function __construct(
        private Money $amount,
    )
    {
        $this->generateIdentity();
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function applyExpense(Expense $expense): self
    {
        if ($expense->amount->minors > $this->amount->minors) {
            throw new BalanceLessThanExpenseException();
        }

        $this->amount = $this->amount->subtract($expense->amount);

        return $this;
    }

    public function applyIncome(Income $expense): self
    {
        $this->amount = $this->amount->add($expense->amount);

        return $this;
    }
}
