<?php

namespace App\Application\ORMRepositories;

use App\Domain\Category\CategoryRepository;
use Doctrine\ORM\EntityRepository;

class ORMCategoryRepository extends EntityRepository implements CategoryRepository
{
    public function isExistByName(string $name): bool
    {
        // TODO: Implement isExistByName() method.
    }
}
