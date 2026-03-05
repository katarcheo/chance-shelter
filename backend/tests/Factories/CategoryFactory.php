<?php

namespace App\Tests\Factories;

use App\Domain\Category\Category;
use App\Domain\DomainId;

class CategoryFactory extends Factory
{
    protected string $entity = Category::class;

    protected function definition(): array
    {
        return [
            'id' => new DomainId($this->faker->uuid),
            'name' => $this->faker->word,
        ];
    }
}
