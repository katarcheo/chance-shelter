<?php

namespace App\Tests\Factories;

use App\Domain\Category\Category;

class CategoryFactory extends Factory
{
    protected string $entity = Category::class;

    protected function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->word,
        ];
    }
}
