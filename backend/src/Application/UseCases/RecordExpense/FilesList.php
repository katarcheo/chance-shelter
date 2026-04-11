<?php

namespace App\Application\UseCases\RecordExpense;

use App\Infrastructure\Support\TypedList;
use Symfony\Component\HttpFoundation\File\File;

readonly class FilesList extends TypedList
{
    public function __construct(File ...$media)
    {
        parent::__construct($media);
    }
}
