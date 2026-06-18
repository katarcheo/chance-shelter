<?php

namespace App\Support;

use App\Tests\Support\Mother\ExpenseMother;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template T
 * @implements IteratorAggregate<int, T>
 */
readonly class TypedList implements IteratorAggregate, Countable, \ArrayAccess
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

    public function map(callable $fn): array
    {
        return array_map(fn($item) => $fn($item), $this->list);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->list[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->list[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \Exception('TypedList is Immutable');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \Exception('TypedList is Immutable');
    }
}
