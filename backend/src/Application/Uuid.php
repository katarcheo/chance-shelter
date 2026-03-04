<?php

namespace App\Application;

use App\Domain\DomainId;
use Symfony\Component\Uid\UuidV7;

class Uuid
{
    public static function generate(): DomainId
    {
        return new DomainId(UuidV7::generate());
    }
}
