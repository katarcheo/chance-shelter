<?php

namespace App\Application\ORMRepositories;

use App\Domain\Entity;
use Doctrine\ORM\EntityRepository;

class ORMBaseRepository extends EntityRepository
{
    protected function simpleSave(Entity $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}
