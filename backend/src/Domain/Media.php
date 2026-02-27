<?php

namespace App\Domain;

class Media
{
    public function __construct(private string $filepath)
    {}

    public function getFileName(): string
    {
        preg_match('/([^\/]+)$/', $this->filepath, $matches);

        return $matches[1];
    }
}
