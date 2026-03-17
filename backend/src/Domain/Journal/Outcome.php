<?php

namespace App\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\Entity;
use App\Domain\Media;
use App\Domain\Money;
use Doctrine\Common\Collections\Collection;

final class Outcome extends Entity
{
    private Collection $media;

    public function __construct(
        public Money $amount,
        public Category $category,
        public ?string $description = null,
    )
    {
        $this->generateIdentity();
    }

    public function addMedia(Media $medias): void
    {

    }
}
