<?php

namespace App\Domain\Category;

class CategoryAlreadyExists extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Category already exists');
    }
}
