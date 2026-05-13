<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Entity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineBaseRepository extends ServiceEntityRepository
{
    protected function simpleSave(Entity $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}
