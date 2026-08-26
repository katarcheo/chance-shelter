<?php

namespace App\Infrastructure\Doctrine\Checkers;

use App\Domain\Category\CategoryNameIsFree;
use App\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Doctrine\DBAL\Connection;

class DoctrineCategoryNameIsFree implements CategoryNameIsFree
{
    public function __construct(
        private DoctrineCategoryRepository $categoryRepo,
        private Connection                 $connection,
    )
    {
    }

    public function isFree(string $categoryName): bool
    {
        $this->connection->executeQuery(
            "SELECT pg_advisory_xact_lock(hashtext(?))",
            ['category_name:' . $categoryName],
        );

        return !$this->categoryRepo->isExistByName($categoryName);
    }
}
