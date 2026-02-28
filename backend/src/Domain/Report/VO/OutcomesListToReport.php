<?php

namespace App\Domain\Report\VO;

use App\Infrastructure\TypedList;

readonly final class OutcomesListToReport extends TypedList
{
    public function __construct(OutcomeToReport ...$list)
    {
        parent::__construct($list);
    }

}
