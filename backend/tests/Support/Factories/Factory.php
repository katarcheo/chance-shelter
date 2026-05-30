<?php

namespace Tests\Support\Factories;

abstract class Factory
{
    protected string $entity;
    protected array $properties;
    protected \Faker\Generator $faker;

    final public function __construct(array $state  = [])
    {
        $this->faker = \Faker\Factory::create();
        $this->properties = [
            ...$this->definition(),
            ...$state,
        ];
    }

    final public function state(array $state): self
    {
        $this->properties = [
            ...$this->properties,
            ...$state,
        ];

        return $this;
    }

    final public function make(): object
    {
//        $reflection = new \ReflectionClass($this->entity);
//        $instance = $reflection->newInstanceWithoutConstructor();
//
//        foreach ($this->properties as $property => $value) {
//            $reflectionProperty = $reflection->getProperty($property);
//            $reflectionProperty->setValue($instance, $value);
//        }

        return new $this->entity(...$this->properties);
    }

    abstract protected function definition(): array;
}
