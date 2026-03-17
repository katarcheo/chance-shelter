<?php

namespace App\Domain\Journal;

use App\Domain\Fund\Fund;
use App\Domain\Money;
use Symfony\Component\Uid\UuidV7;
use Doctrine\ORM\Mapping as ORM;

final class Income
{
    #[ORM\Id]
    private string $id;

    public function __construct(
        public Money $amount,
        public Fund $fund,
    )
    {
        $this->id = UuidV7::generate();
    }
}
