<?php

namespace App\Tests\Support;

use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\Repository\JournalRepository;

trait HasRepositories
{
    private CategoryRepository $categoryRepo;
    private JournalRepository $journalRepo;
}
