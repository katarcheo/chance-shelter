<?php

namespace App\Tests\Support\Mother;

use Faker\Factory;
use Faker\Generator;

abstract class ObjectMother
{
    protected static function fake(): Generator
    {
        static $faker = Factory::create();
        return $faker;
    }
}
