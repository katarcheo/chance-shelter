<?php

namespace App\Domain\Journal\Repository;

use App\Domain\Ident;
use App\Domain\Media\MediaList;
use App\Domain\Money;

final readonly class ExpenseRecord
{
    public function __construct(
        public Money $amount,
        public string $categoryName,
        public Ident $categoryId,
        public ?string $description,
        public MediaList $attachments,
        public \DateTimeImmutable $receivedAt,
    )
    {}
}
