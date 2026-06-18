<?php

namespace App\Tests\Support\Factories\Fund;

use App\Domain\Fund\Fund;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Fund>
 */
final class FundFactory extends PersistentObjectFactory
{

    #[\Override]
    public static function class(): string
    {
        return Fund::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Fund $fund): void {})
        ;
    }
}
