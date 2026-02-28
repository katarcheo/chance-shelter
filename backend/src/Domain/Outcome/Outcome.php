<?php

namespace App\Domain\Outcome;

use App\Domain\Category;
use App\Domain\DomainId;
use App\Domain\Medias;
use App\Domain\Money;

readonly final class Outcome
{
    public function __construct(
        public DomainId $id,
        public Money $amount,
        public ?string $description,
        public Category $category,
        public Medias $media,
    )
    {}
}
