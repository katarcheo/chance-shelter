<?php

namespace App\Domain\Category;

use App\Domain\Ident;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Category
{
    private function __construct(
        #[ORM\Id]
        #[ORM\Column(type: IdentType::NAME)]
        private Ident $id,
        #[ORM\Column]
        private string $name,
    )
    {
    }

    public static function create(
        Ident $id,
        string $name,
        CategoryNameIsFree $availability,
    ): self
    {
        if (!$availability->isFree($name)) {
            throw new CategoryAlreadyExists();
        }

        return new self($id, $name);
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
