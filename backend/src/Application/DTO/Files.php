<?php

namespace App\Application\DTO;

use App\Infrastructure\TypedList;
use Symfony\Component\HttpFoundation\File\File;

readonly class Files extends TypedList
{
    public function __construct(File ...$media)
    {
        parent::__construct($media);
    }
}
