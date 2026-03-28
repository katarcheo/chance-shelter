<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryRepository;

class DoctrineCategoryRepository extends DoctrineBaseRepository implements CategoryRepository
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
