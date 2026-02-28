<?php

namespace App\Domain\Category;

use App\Domain\DomainId;

class Category
{
    public function __construct(
        public DomainId $id,
        public string $name,
    )
    {}
}
