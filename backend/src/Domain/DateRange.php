<?php

namespace App\Domain;

use \DateTimeImmutable;

final class DateRange
{
    public function __construct(private DateTimeImmutable $from, private DateTimeImmutable $to)
    {
        if ($from > $to) {
            throw new \InvalidArgumentException('From date must be greater than or equal to to');
        }
    }

    public function getFrom(): DateTimeImmutable
    {
        return $this->from;
    }

    public function getTo(): DateTimeImmutable
    {
        return $this->to;
    }
}
