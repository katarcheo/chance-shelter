<?php

namespace App\Tests\Factories;

use App\Domain\Fund\Fund;
use App\Domain\Journal\Income;
use App\Domain\Money;

class IncomeFactory extends Factory
{
    protected string $entity = Income::class;

    protected function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'amount' => new Money($this->faker->randomNumber(3)),
            'fund' => new Fund(),
        ];
    }

    public function amount(int $amount): self
    {
        return $this->state([
            'amount' => new Money($amount),
        ]);
    }
}
