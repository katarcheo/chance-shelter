<?php

namespace App\Tests\Support\Mother;

use App\Domain\Category\Category;
use App\Domain\Journal\Repository\ExpenseRecord;
use App\Domain\Money;

class ExpenseMother extends ObjectMother
{
    public static function record(
        ?int    $amount = null,
        ?Category $category = null,
        ?string    $description = null,
        ?\DateTime $receivedAt = null,
    ): ExpenseRecord
    {
        $amount ??= self::fake()->numberBetween(10, 100);
        $category ??= CategoryMother::make();
        $description ??= self::fake()->sentence();
        $receivedAt ??= self::fake()->dateTimeThisMonth();

        return new ExpenseRecord(
            amount: new Money($amount),
            categoryName: $category->getName(),
            categoryId: $category->id,
            description: $description,
            receivedAt: \DateTimeImmutable::createFromMutable($receivedAt),
        );
    }
}
