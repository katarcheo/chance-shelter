<?php

namespace App\Infrastructure\Http\Resource;

use App\Application\UseCases\AddCategory\CreatedCategoryResult;

readonly class CreatedCategoryResource extends Resource
{
    public function __construct(
        string $categoryId,
    )
    {
    }

    public static function from(CreatedCategoryResult $categoryResult): self
    {
        return new self(
            categoryId: $categoryResult->id->toString(),
        );
    }
}
