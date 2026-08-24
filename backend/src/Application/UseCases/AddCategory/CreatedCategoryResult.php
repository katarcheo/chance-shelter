<?php

namespace App\Application\UseCases\AddCategory;

use App\Domain\Ident;

readonly class CreatedCategoryResult
{
    public function __construct(
        public readonly Ident $id,
    )
    {
    }
}
