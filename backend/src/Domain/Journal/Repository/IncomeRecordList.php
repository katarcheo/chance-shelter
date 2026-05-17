<?php

namespace App\Domain\Journal\Repository;

use App\Support\TypedList;

final readonly class IncomeRecordList extends TypedList
{
    public function __construct(IncomeRecord ...$items)
    {
        parent::__construct($items);
    }
}
