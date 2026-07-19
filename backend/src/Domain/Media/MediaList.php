<?php

namespace App\Domain\Media;

use App\Support\TypedList;

final readonly class MediaList extends TypedList
{
    public function __construct(MediaRef ...$items)
    {
        parent::__construct($items);
    }
}
