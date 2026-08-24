<?php

namespace App\Application\UseCases\AddCategory;

use App\Application\Exceptions\ApplicationException;

class CategoryAlreadyExists extends ApplicationException
{
    public function __construct()
    {
        parent::__construct('Category already exists');
    }
}
