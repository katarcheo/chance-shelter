<?php

namespace App\Infrastructure\Doctrine\Entities;

use App\Domain\Ident;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Media
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME)]
        private Uuid $id,
        #[ORM\Column]
        private string $storageKey,
    )
    {
    }

    public function id(): Uuid
    {
        return $this->id;
    }
}
