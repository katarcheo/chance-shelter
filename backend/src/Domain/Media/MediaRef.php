<?php

namespace App\Domain\Media;

readonly final class MediaRef
{
    public function __construct(public string $key)
    {
    }
}
