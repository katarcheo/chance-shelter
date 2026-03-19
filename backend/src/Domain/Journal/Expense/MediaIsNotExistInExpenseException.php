<?php

namespace App\Domain\Journal\Expense;

class MediaIsNotExistInExpenseException extends \DomainException
{

    public function __construct(string $filename)
    {
        parent::__construct("Expense does not have the media `$filename`");
    }
}
