<?php

namespace App\Domain\Journal;

use App\Domain\Fund\Fund;
use App\Domain\Ident;
use App\Domain\Money;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity]
final class Income
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: IdentType::NAME)]
        private Ident $id,
        #[ORM\Embedded]
        private Money              $amount,
        #[ORM\ManyToOne(inversedBy: 'incomes')]
        private Fund               $fund,
        #[ORM\ManyToOne(inversedBy: 'incomes')]
        private Balance            $balance,
        #[ORM\Column]
        private \DateTimeImmutable $receivedAt,
    )
    {
    }

    public function id(): Ident
    {
        return $this->id;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getFund(): Fund
    {
        return $this->fund;
    }
}
