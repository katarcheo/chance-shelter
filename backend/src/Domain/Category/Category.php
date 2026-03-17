<?php

namespace App\Domain\Category;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV7;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
final class Category
{
    #[ORM\Id]
    private string $id;

    public function __construct(
        #[ORM\Column]
        private string $name,
    )
    {
        $this->id = UuidV7::generate();
    }

    public function name(): string
    {
        return $this->name;
    }
}
