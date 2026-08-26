<?php

namespace App\Domain\Category;

interface CategoryRepository
{
    public function create(Category $category): void;
}
