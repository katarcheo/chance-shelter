<?php

namespace App\Domain\Media;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
readonly final class MediaRef
{
    public function __construct(
        #[ORM\Column(type: 'string')]
        public string $key,
    )
    {
    }
}
