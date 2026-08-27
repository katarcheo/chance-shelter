<?php

namespace App\Application\UseCases\JournalRecording\RecordIncome;

class FundNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Fund not found');
    }
}
