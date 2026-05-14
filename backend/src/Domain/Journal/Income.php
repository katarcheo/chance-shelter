<?php

namespace App\Domain\Journal;

use App\Domain\Entity;
use App\Domain\Fund\Fund;
use App\Domain\Money;
use Doctrine\ORM\Mapping as ORM;

final class Income extends Entity
{
    public function __construct(
        #[ORM\Embedded]
        private Money $amount,
        #[ORM\OneToMany]
        private Fund $fund,
        #[ORM\ManyToOne(inversedBy: 'incomes')]
        private Journal $journal,
    )
    {
        $this->generateIdentity();
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
