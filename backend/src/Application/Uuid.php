<?php

namespace App\Application;

use App\Domain\DomainId;
use Symfony\Component\Uid\UuidV7;

class Uuid extends DomainId
{
    public static function generate(): self
    {
        return new static(UuidV7::generate());
    }
}
