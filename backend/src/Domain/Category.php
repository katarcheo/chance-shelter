<?php

namespace App\Domain;

class Category
{
    public function __construct(
        public DomainId $id,
        public string $name,
    )
    {}
}
