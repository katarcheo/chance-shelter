<?php

namespace App\Domain\ValueObject;

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
