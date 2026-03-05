<?php

namespace App\Tests\Factories;

use App\Domain\Category\Category;
use App\Domain\DomainId;
use App\Domain\Journal\Outcome;
use App\Domain\Medias;
use App\Domain\Money;

class OutcomeFactory extends Factory
{
    protected string $entity = Outcome::class;

    protected function definition(): array
    {
        return [
            'id' => new DomainId($this->faker->uuid),
            'amount' => new Money($this->faker->randomNumber(3)),
            'category' => new CategoryFactory()->make(),
            'media' => new Medias(),
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
}
