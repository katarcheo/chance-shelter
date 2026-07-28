<?php

namespace App\Application\UseCases\JournalRecording\RecordExpense;

use App\Domain\Ident;
use App\Domain\Media\MediaList;
use Carbon\CarbonImmutable;

readonly class CreateExpenseCommand
{
    public function __construct(
        public float $amount,
        public ?string $description,
        public Ident $categoryId,
        public MediaList $attachments,
        public CarbonImmutable $createdAt,
    )
    {
    }
}
