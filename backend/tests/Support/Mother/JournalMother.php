<?php

namespace Tests\Support\Mother;

use App\Domain\Journal\Journal;
use App\Domain\Money;

class JournalMother
{
    public static function  withBalance(float $amount): Journal
    {
        return new Journal(
            new Money($amount * 100),
        );
    }
}
