<?php

namespace Tests\Support\Factories;

use App\Domain\Category\Category;

class CategoryFactory extends Factory
{
    protected string $entity = Category::class;

    protected function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
