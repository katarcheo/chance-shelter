<?php

namespace App\Domain;


use Domain\ValueObject\OutcomesListToReport;

interface Journal
{
    public function addIncome(float $value): void;
    public function addOutcome(float $value, string $category): void;
    public function getFullIncomeByPeriod(\DateTime $from, \DateTime $to): float;
    public function getOutcomesByPeriod(\DateTime $from, \DateTime $to): OutcomesListToReport;
}
