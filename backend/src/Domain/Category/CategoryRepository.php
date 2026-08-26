<?php

namespace App\Domain\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
}
