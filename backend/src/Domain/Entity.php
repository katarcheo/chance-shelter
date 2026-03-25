<?php

namespace App\Domain;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV7;

#[MappedSuperclass]
abstract class Entity
{
    #[ORM\Id]
    readonly public string $id;

    final public function generateIdentity(): void
    {
        $this->id = UuidV7::generate();
    }

    final public function id(): string
    {
        return $this->id;
    }
}
