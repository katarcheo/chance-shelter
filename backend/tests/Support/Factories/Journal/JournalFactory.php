<?php

namespace App\Tests\Support\Factories\Journal;

use App\Domain\Category\Category;
use App\Domain\Fund\Fund;
use App\Domain\Journal\Journal;
use App\Domain\Money;
use App\Tests\Support\Factories\Category\CategoryFactory;
use App\Tests\Support\Factories\Fund\FundFactory;
use Carbon\CarbonImmutable;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Journal>
 */
final class JournalFactory extends PersistentObjectFactory
{
    #[\Override]
    public static function class(): string
    {
        return Journal::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'balance' => new Money(self::faker()->randomNumber(3)),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this// ->afterInstantiate(function(Journal $journal): void {})
            ;
    }

    public function withExpense(
        null|int|Money      $amount = null,
        ?Category           $category = null,
        ?string             $description = null,
        ?\DateTimeImmutable $receivedAt = null,
    ): static
    {
        return $this->afterInstantiate(
            fn(Journal $journal) => $journal->applyExpense(
                amount:      $amount instanceof Money ? $amount : new Money($amount),
                category:    $category ?? CategoryFactory::new()->create(),
                receivedAt:  $receivedAt ?? CarbonImmutable::now(),
                description: $description,
            )
        );
    }

    public function withIncome(
        null|int|Money      $amount = null,
        ?Fund               $fund = null,
        ?\DateTimeImmutable $receivedAt = null,
    ): static
    {
        return $this->afterInstantiate(
            fn(Journal $journal) => $journal->applyIncome(
                amount: $amount instanceof Money ? $amount : new Money($amount),
                fund: $fund ?? FundFactory::new()->create(),
                receivedAt: $receivedAt ?? CarbonImmutable::now(),
            )
        );
    }
}
