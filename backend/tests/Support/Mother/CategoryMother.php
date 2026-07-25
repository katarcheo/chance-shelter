<?php

namespace App\Tests\Support\Mother;

use App\Domain\Category\Category;
use App\Domain\Ident;

class CategoryMother extends ObjectMother
{
    public static function make(): Category
    {
        return new Category(
            Ident::new(),
            self::fake()->word()
        );
    }
}
