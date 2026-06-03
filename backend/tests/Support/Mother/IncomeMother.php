<?php

namespace App\Tests\Support\Mother;

use App\Domain\Journal\Repository\IncomeRecord;
use App\Domain\Journal\Repository\IncomeRecordList;
use App\Domain\Money;

class IncomeMother extends ObjectMother
{
    public static function listWithAmounts(float ...$amounts): IncomeRecordList
    {
        $list = [];

        foreach ($amounts as $amount) {
            $list[] = self::recordWithAmount($amount);
        }

        return new IncomeRecordList(...$list);
    }

    public static function recordWithAmount(float $amount): IncomeRecord
    {
        return new IncomeRecord(
            amount: new Money($amount),
            fundName: self::fake()->word(),
            fundId: self::fake()->uuid(),
        );
    }
}
