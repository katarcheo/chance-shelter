<?php

namespace App\Domain;

readonly final class Income
{
    public function __construct(
        public int $id,
        public Money $amount,
        public Fund $fund,
    )
    {}
}
