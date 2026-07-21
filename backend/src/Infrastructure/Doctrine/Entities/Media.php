<?php

namespace App\Infrastructure\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV7;

#[ORM\Entity]
class Media
{
    #[ORM\Id]
    #[ORM\Column]
    readonly public string $id;

    public function __construct(
        #[ORM\Column]
        private string $storageKey,
    )
    {
        $this->id = UuidV7::generate();
    }
}
