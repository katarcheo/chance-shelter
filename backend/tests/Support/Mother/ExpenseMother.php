<?php

namespace Tests\Support\Mother;

use App\Domain\Category\Category;
use App\Domain\Journal\Repository\ExpenseRecord;
use App\Domain\Money;

class ExpenseMother extends ObjectMother
{
    public static function record(
        ?float    $amount = null,
        ?Category $category = null,
        ?string    $description = null
    ): ExpenseRecord
    {
        $amount ??= self::fake()->numberBetween(10, 100);
        $category ??= CategoryMother::make();
        $description ??= self::fake()->sentence();

        return new ExpenseRecord(
            amount: new Money($amount * 100),
            categoryName: $category->getName(),
            categoryId: $category->id,
            description: $description,
        );
    }
}
