<?php

namespace App\Domain\Repository;

use App\Domain\Category\Category;

interface CategoryRepository
{
    public function findById(int $id): ?Category;
    public function isExistByName(string $name): bool;
    public function add(Category $category): void;
}
