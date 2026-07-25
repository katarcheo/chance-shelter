<?php

namespace App\Tests\Application\UseCases\Media;

use App\Infrastructure\Doctrine\Entities\Media;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\ByteString;
use Symfony\Component\Uid\UuidV7;

class RecordUploadedMediaService
{
    public function __construct(
        private FilesystemOperator $storage,
        private EntityManagerInterface $em,
    )
    {
    }

    public function __invoke(UploadedFile $file, ?string $group = null): Media
    {
        $key = ByteString::fromRandom(7);
        $storageKey = "$key.{$file->guessExtension()}";

        if ($group) {
            $storageKey = "$group./$storageKey";
        }

        $this->storage->writeStream($storageKey, fopen($file->getPathname(), 'rb'));

        $media = new Media(
            id: new UuidV7,
            storageKey: $storageKey,
        );
        $this->em->persist($media);

        return $media;
    }
}
