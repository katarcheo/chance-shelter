<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Category\CategoryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineCategoryRepository extends EntityRepository implements CategoryRepository
{
    public function isExistByName(string $name): bool
    {
        // TODO: Implement isExistByName() method.
    }
}
