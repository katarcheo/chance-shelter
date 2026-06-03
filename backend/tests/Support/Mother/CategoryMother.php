<?php

namespace App\Tests\Support\Mother;

use App\Domain\Category\Category;

class CategoryMother extends ObjectMother
{
    public static function make(): Category
    {
        return new Category(self::fake()->word());
    }
}
