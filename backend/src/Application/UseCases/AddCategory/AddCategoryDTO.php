<?php

namespace App\Application\UseCases\AddCategory;

use Symfony\Component\Validator\Constraints as Assert;

readonly class AddCategoryDTO
{
    public function __construct(
        #[Assert\Length(min: 1, max: 255)]
        public string $name
    )
    {}
}
