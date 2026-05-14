<?php

namespace Tests\Factories;

use App\Domain\Category\Category;
use App\Domain\Journal\Expense\Expense;
use App\Domain\Money;

class ExpenseFactory extends Factory
{
    protected string $entity = Expense::class;

    protected function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'amount' => new Money($this->faker->randomNumber(3)),
            'category' => new CategoryFactory()->make(),
        ];
    }

    public function amount(int $amount): self
    {
        return $this->state([
            'amount' => new Money($amount),
        ]);
    }

    public function category(Category $category): self
    {
        return $this->state(['category' => $category]);
    }

    public function media(?string $path = null): self
    {
        return $this->state(['media' => [$path ?? $this->faker->filePath()]]);
    }
}
