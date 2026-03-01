<?php

namespace App\Domain\Category;

use App\Domain\DomainId;

final class Category
{
    public function __construct(
        public DomainId $id,
        public string $name,
    )
    {}
}
