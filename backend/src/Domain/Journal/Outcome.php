<?php

namespace App\Domain\Journal;

use App\Domain\Category\Category;
use App\Domain\Medias;
use App\Domain\Money;
use Symfony\Component\Uid\UuidV7;
use Doctrine\ORM\Mapping as ORM;

final class Outcome
{
    #[ORM\Id]
    private string $id;

    public function __construct(
        public Money $amount,
        public Category $category,
        public Medias $media,
        public ?string $description = null,
    )
    {
        $this->id = UuidV7::generate();
    }
}
