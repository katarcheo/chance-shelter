<?php

namespace Domain\ValueObject;

final class Money
{
    public function __construct(private int $minors)
    {}

    public function getMinors(): int
    {
        return $this->minors;

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
