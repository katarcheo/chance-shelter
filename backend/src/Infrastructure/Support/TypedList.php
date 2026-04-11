<?php

namespace App\Infrastructure\Support;

use Countable;
use IteratorAggregate;
use Traversable;

readonly class TypedList implements IteratorAggregate, Countable
{
    protected function __construct(protected array $list)
    {}

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->list);
    }

    public function count(): int
    {
        return count($this->list);
    }
}
