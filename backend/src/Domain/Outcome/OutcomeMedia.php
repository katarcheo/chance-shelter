<?php

namespace App\Domain\Outcome;

use App\Domain\Media;

final readonly class OutcomeMedia
{
    public array $list;

    public function __construct(Media ...$list)
    {
        $this->list = $list;
    }
}
