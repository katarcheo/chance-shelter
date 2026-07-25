<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Domain\Ident;

readonly class CreateExpenseCommand
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public Ident $categoryId,
        public UploadedFileList $media,
    )
    {
//        TODO: check mime types
    }
}
