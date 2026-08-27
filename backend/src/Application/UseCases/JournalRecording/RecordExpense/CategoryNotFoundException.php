<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

class CategoryNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Category not found");
    }
}
