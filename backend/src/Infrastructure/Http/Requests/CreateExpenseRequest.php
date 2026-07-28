<?php

namespace App\Infrastructure\Http\Requests;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateExpenseRequest
{
    readonly public array $attachments;
    public function __construct(
        #[Assert\GreaterThan(0)]
        public float $amount,
        public ?string $description,
        #[Assert\Uuid(versions: 7)]
        public string $categoryId,
        #[Assert\DateTime]
        public ?string $createdAt,
        UploadedFile ...$attachments,
    )
    {
        $this->attachments = $attachments;
    }
}
