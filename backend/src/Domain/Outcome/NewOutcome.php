<?php

namespace App\Domain\Outcome;

use App\Domain\Category;
use App\Domain\Money;

readonly final class NewOutcome
{
    public function __construct(
        public Money $amount,
        public ?string $description,
        public Category $category,
        public OutcomeMedia $media,
    )
    {}
}
