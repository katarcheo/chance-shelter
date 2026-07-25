<?php

namespace App\Domain\Category;

use App\Domain\Ident;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Category
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: IdentType::NAME)]
        private Ident $id,
        #[ORM\Column]
        private string $name,
    )
    {
    }

    public function id(): Ident
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
