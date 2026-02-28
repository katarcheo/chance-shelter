<?php

namespace App\Domain\Income;

use App\Infrastructure\TypedList;

final readonly class IncomeList extends TypedList
{
    public function __construct(Income ...$income)
    {
        parent::__construct(...$income);
    }
}
