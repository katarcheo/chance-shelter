<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Entity;
use Doctrine\ORM\EntityRepository;

class DoctrineBaseRepository extends EntityRepository
{
    protected function simpleSave(Entity $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}
