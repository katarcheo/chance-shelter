<?php

namespace App\Domain\Category;

interface CategoryNameIsFree
{
    public function isFree(string $categoryName): bool;
}
