<?php

namespace App\Infrastructure\Doctrine\Entities;

use App\Domain\Ident;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity]
class Media
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UUidType::NAME)]
        private Ident $id,
        #[ORM\Column]
        private string $storageKey,
    )
    {
    }

    public function id(): Ident
    {
        return $this->id;
    }
}
