<?php

namespace App\Domain;

class DomainId
{
    final public function __construct(private string $value)
    {}

    final public function __toString(): string
    {
        return $this->value;
    }
}
