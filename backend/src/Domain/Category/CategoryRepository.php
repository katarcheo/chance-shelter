<?php

namespace App\Domain\Category;

interface CategoryRepository
{
    public function isExistByName(string $name): bool;
    public function create(Category $category): void;
}
