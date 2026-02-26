<?php

namespace App\Domain\Report\VO;

final class ReportOutcomesList
{
    /**
     * @var ReportOutcome[]
     */
    private array $list {
        get {
            return $this->list;
        }
    }

    public function __construct(ReportOutcome ...$list)
    {
        $this->list = $list;
    }

}
