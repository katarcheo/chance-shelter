<?php

namespace App\Application\UseCases\Media;

use App\Infrastructure\Doctrine\Entities\Media;
use App\Infrastructure\Doctrine\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\ByteString;
use Symfony\Component\Uid\UuidV7;

class RecordUploadedMediaService
{
    public function __construct(
        private FilesystemOperator $storage,
        private MediaRepository $mediaRepo,
    )
    {
    }

    public function __invoke(UploadedFile $file, ?string $group = null): Media
    {
        $id = new UuidV7;
        $storageKey = "$id.{$file->guessExtension()}";

        if ($group) {
            $storageKey = "$group/$storageKey";
        }

        $this->storage->writeStream($storageKey, fopen($file->getPathname(), 'rb'));

        $media = new Media(
            id: $id,
            storageKey: $storageKey,
        );

        $this->mediaRepo->add($media);

        return $media;
    }
}
