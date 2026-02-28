<?php

namespace App\Domain;

abstract class DomainId
{
    public function __construct(private string $value)
    {}

    final public function __toString(): string
    {
        return $this->value;
    }

    abstract public static  function generate(): self;
}
