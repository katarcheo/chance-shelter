<?php

namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class Money
{
    private const int MAJOR_COFF = 100;

    public function __construct(
        #[Column]
        private int $minors,
        #[Column(type: 'string', enumType: Currency::class)]
        private Currency $currency = Currency::KZT,
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
