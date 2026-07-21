<?php

namespace App\Domain\Fund;

use App\Domain\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Fund extends Entity
{
    public function __construct(
        #[ORM\Column]
        private string $name,
    )
    {
        $this->initializeIdentity();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
