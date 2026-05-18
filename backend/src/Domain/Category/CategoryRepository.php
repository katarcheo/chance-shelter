<?php

namespace App\Domain\Category;

interface CategoryRepository
{
    public function find(string $id): ?Category;
    public function isExistByName(string $name): bool;
}
