<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Media extends Entity
{
    #[ORM\Column]
    private string $path;

    public function __construct(\SplFileInfo $file)
    {
        $this->generateIdentity();
    }
}
