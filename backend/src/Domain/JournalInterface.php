<?php

namespace App\Domain;

interface JournalInterface
{
    public function addIncome(): void;
    public function addOutcome(): void;
    public function getFullIncomeByPeriod(): float;
    public function getOutcomesByPeriod(): void;
}
