<?php

namespace App\Infrastructure\Doctrine\Types;


use App\Domain\Ident;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Bridge\Doctrine\Types\UuidType;

class IdentType extends Type
{
    public const NAME = 'ident';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Ident
    {
        $uuid = new UuidType()->convertToPHPValue($value, $platform);
        return Ident::from($uuid->toRfc4122());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return new UuidType()->convertToDatabaseValue((string) $value, $platform);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return new UuidType()->getSQLDeclaration($column, $platform);
    }
}
