<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Support\TypedList;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class UploadedFileList extends TypedList
{
    public function __construct(UploadedFile ...$media)
    {
        parent::__construct($media);
    }
}
