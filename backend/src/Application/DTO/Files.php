<?php

namespace App\Application\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class Files
{
    public array $list;
    public function __construct(UploadedFile ...$media)
    {
        $this->list = $media;
    }
}
