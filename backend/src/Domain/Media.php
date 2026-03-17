<?php

namespace App\Domain;

use App\Infrastructure\TypedList;

readonly final class Media extends TypedList
{
    public function __construct(\SplFileInfo ...$media)
    {
        parent::__construct($media);
    }
}
