<?php

namespace App\Application;

use App\Application\DTO\OutcomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Application\Repository\CategoryRepository;
use App\Application\Repository\JournalRepository;
use App\Domain\Medias;
use App\Domain\Money;
use App\Domain\Outcome\Outcome;

class RecordOutcomeService
{
    public function __construct(
        private JournalRepository $journalRepository,
        private CategoryRepository $categoryRepository,
    )
    {}

    public function record(OutcomeDTO $outcomeData): void
    {
        if (!$category = $this->categoryRepository->findById($outcomeData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        foreach ($outcomeData->media as $file) {
            $file->move();
        }

        $outcome = new Outcome(
            id: Uuid::generate(),
            amount: Money::fromFloat($outcomeData->amount),
            description: $outcomeData->description,
            category: $category,
            media: new Medias(...$outcomeData->media),
        );

        $this->journalRepository->recordOutcome($outcome);
    }
}
