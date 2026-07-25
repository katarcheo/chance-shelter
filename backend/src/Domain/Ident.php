<?php

namespace App\Domain;

use Symfony\Component\Uid\UuidV7;

readonly final class Ident
{
    private function __construct(private UuidV7 $uuid)
    {
    }

    public function toString(): string
    {
        return $this->uuid->toRfc4122();
    }

    public static function new(): self
    {
        return new self(new UuidV7);
    }

    public function from(string $value): self
    {
        return new self(UuidV7::fromString($value));
    }

    public function equals(Ident $ident): bool
    {
        return $ident->toString() === $this->toString();
    }
}
