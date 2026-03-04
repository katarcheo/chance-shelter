<?php

namespace App\Domain;

readonly final class Money
{
    private const int MAJOR_COFF = 100;

    public function __construct(
        public int $minors
    )
    {}

    public static  function fromFloat(float $amount): self
    {
        return new self($amount * self::MAJOR_COFF);
    }

    public function toFloat(): float
    {
        return  $this->minors / self::MAJOR_COFF;
    }

    public function add(Money $other): self
    {
        return new self($this->minors + $other->minors);
    }

    public function subtract(Money $other): self
    {
        return new self($this->minors - $other->minors);
    }
}
