<?php

namespace App\Infrastructure;

use IteratorAggregate;
use Traversable;

readonly class TypedList implements IteratorAggregate
{
    protected function __construct(private array $list)
    {}

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->list);
    }
}
