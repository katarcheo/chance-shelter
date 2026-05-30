<?php

namespace App\Domain\Category;

use App\Domain\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Category extends Entity
{
    public function __construct(
        #[ORM\Column]
        private string $name,
    )
    {
        $this->generateIdentity();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
