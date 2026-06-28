<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Fund\Fund;
use App\Domain\Fund\FundRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFundRepository extends ServiceEntityRepository implements FundRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fund::class);
    }
}
