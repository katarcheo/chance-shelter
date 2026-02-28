<?php

namespace App\Domain\Repository;

use App\Domain\Fund;

interface FundRepository
{
    public function findById(int $id): ?Fund;
}
