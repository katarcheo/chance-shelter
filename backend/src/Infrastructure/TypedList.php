<?php

namespace App\Infrastructure;

use IteratorAggregate;
use Traversable;

readonly class TypedList implements IteratorAggregate
{
    protected function __construct(protected array $list)
    {}

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->list);
    }
}
