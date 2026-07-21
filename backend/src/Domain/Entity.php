<?php

namespace App\Domain;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;

#[MappedSuperclass]
abstract class Entity
{
    #[ORM\Id]
    #[ORM\Column(type: UUidType::NAME)]
    protected readonly Uuid $id;

    final protected function initializeIdentity(): void
    {
        $this->id = new UuidV7;
    }

    final public function id(): Uuid
    {
        return $this->id;
    }
}
