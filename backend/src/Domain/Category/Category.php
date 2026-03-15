<?php

namespace App\Domain\Category;

use App\Domain\DomainId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
final class Category
{
    public function __construct(
        #[ORM\Id]
        private DomainId $id,
        #[ORM\Column]
        private string $name,
    )
    {}

    public function name(): string
    {
        return $this->name;
    }
}
