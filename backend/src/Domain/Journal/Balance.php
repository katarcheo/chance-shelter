<?php

namespace App\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\Fund\Fund;
use App\Domain\Ident;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Money;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Balance
{
    #[ORM\OneToMany(targetEntity: Income::class, mappedBy: 'journal', cascade:  ['persist', 'remove'])]
    private Collection $incomes;
    #[ORM\OneToMany(targetEntity: Expense::class, mappedBy: 'journal', cascade: ['persist', 'remove'])]
    private Collection $expenses;

    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: IdentType::NAME)]
        private Ident $id,
        #[ORM\Embedded]
        private Money $amount,
    )
    {
        $this->incomes = new ArrayCollection();
        $this->expenses = new ArrayCollection();
    }

    public function applyExpense(
        Money              $amount,
        Category           $category,
        \DateTimeImmutable $receivedAt,
        ?string            $description = null
    ): Expense
    {
        $expense = new Expense(
            id: Ident::new(),
            amount:      $amount,
            category:    $category,
            balance:     $this,
            receivedAt:  $receivedAt,
            description: $description,
        );

        if ($amount->getMinors() > $this->amount->getMinors()) {
            throw new BalanceLessThanExpenseException();
        }

        $this->amount = $this->amount->subtract($amount);
        $this->expenses[] = $expense;

        return $expense;
    }

    public function applyIncome(Money $amount, Fund $fund, \DateTimeImmutable $receivedAt): Income
    {
        $income = new Income(Ident::new(), $amount, $fund, $this, $receivedAt);
        $this->incomes[] = $income;
        $this->amount = $this->amount->add($amount);

        return $income;
    }

    public function id(): Ident
    {
        return $this->id;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }
}
