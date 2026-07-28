<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Infrastructure\Doctrine\Entities\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function add(Media $media): void
    {
        $em = $this->getEntityManager();
        $em->persist($media);
        $em->flush();
    }
}
