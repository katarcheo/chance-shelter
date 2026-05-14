<?php

namespace App\Infrastructure\Support;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template T
 * @implements IteratorAggregate<int, T>
 */
readonly class TypedList implements IteratorAggregate, Countable
{
    /**
     * @param array<int, T> $list
     */
    protected function __construct(protected array $list)
    {}

    /**
     * @return Traversable<int, T>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->list);
    }

    public function count(): int
    {
        return count($this->list);
    }
}
