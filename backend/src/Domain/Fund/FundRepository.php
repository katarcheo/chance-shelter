<?php

namespace App\Domain\Fund;

interface FundRepository
{
    public function find(string $id): ?Fund;
}
