<?php

namespace App\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\DomainId;
use App\Domain\Medias;
use App\Domain\Money;

readonly final class Outcome
{
    public function __construct(
        public DomainId $id,
        public Money $amount,
        public Category $category,
        public Medias $media,
        public ?string $description = null,
    )
    {}
}
