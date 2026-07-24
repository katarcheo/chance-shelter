<?php

namespace App\Domain\Fund;

use App\Domain\Entity;
use App\Domain\Ident;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity]
final class Fund
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UUidType::NAME)]
        private Ident $id,
        #[ORM\Column]
        private string $name,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
