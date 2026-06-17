<?php

namespace App\Tests\Support;

use App\Domain\Category\CategoryRepository;

trait HasRepositories
{
    public CategoryRepository $categoryRepo;
}
