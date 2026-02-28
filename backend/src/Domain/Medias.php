<?php

namespace App\Domain;

use App\Infrastructure\TypedList;

readonly final class Medias extends TypedList
{
    public function __construct(\SplFileInfo ...$media)
    {
        parent::__construct($media);
    }
}
