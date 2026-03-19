<?php

namespace App\Application\ORMRepositories;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryRepository;

class ORMCategoryRepository extends ORMBaseRepository implements CategoryRepository
{
    public function isExistByName(string $name): bool
    {
        // TODO: Implement isExistByName() method.
    }

    public function save(Category $category): void
    {
        $this->simpleSave($category);
    }
}
