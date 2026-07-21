<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCategoryRepository extends ServiceEntityRepository implements CategoryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function isExistByName(string $name): bool
    {
        $category = Category::class;
        $query = $this->getEntityManager()->createQuery(
            "SELECT c FROM $category c WHERE c.name = '$name'"
        );
        return count($query->getResult()) > 0;
    }
}
