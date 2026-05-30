<?php

namespace Tests\Support\Mother;

use App\Domain\Category\Category;
use Faker\Factory;
use Faker\Generator;

class CategoryMother
{
    private static function fake(): Generator
    {
        static $faker = Factory::create();
        return $faker;
    }

    public static function make(): Category
    {
        return new Category(self::fake()->word());
    }
}
