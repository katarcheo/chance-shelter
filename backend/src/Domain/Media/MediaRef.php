<?php

namespace App\Domain\Media;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Embeddable]
readonly final class MediaRef
{
    public function __construct(
        #[ORM\Column(type: UuidType::NAME)]
        public string $key
    )
    {
    }
}
