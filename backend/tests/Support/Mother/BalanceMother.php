<?php

namespace App\Tests\Support\Mother;

use App\Domain\Ident;
use App\Domain\Journal\Balance;
use App\Domain\Money;

class BalanceMother
{
    public static function  amount(float $amount): Balance
    {
        return new Balance(
            Ident::new(),
            new Money($amount),
        );
    }
}
