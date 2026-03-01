<?php

namespace App\Domain\Fund;

interface FundRepository
{
    public function findById(int $id): ?Fund;
}
