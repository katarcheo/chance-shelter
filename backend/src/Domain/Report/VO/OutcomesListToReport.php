<?php

namespace App\Domain\Report\VO;;
final class OutcomesListToReport
{
    /**
     * @var OutcomeToReport[]
     */
    private array $list {
        get {
            return $this->list;
        }
    }

    public function __construct(OutcomeToReport ...$list)
    {
        $this->list = $list;
    }

}
