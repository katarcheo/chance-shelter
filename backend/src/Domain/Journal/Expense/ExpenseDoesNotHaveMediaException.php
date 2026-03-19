<?php

namespace App\Domain\Journal\Expense;

class ExpenseDoesNotHaveMediaException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Expense does not have a media');
    }
}
