<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

readonly class CreateExpenseCommand
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public string $categoryId,
        public UploadedFileList $media,
    )
    {
//        TODO: check mime types
    }
}
