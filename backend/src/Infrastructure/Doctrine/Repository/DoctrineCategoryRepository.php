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
        $count = $this
            ->getEntityManager()
            ->createQuery(
                "SELECT COUNT(c.id) FROM $category c WHERE c.name = :name"
            )
            ->setParameter('name', $name)
            ->getSingleScalarResult();

        return $count > 0;
    }

    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
    }
}
