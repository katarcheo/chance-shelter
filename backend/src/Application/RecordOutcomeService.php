<?php

namespace App\Application;

use App\Application\DTO\OutcomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\JournalRepository;
use App\Domain\Journal\Outcome;
use App\Domain\Journal\OutcomeAvailabilityService;
use App\Domain\Medias;
use App\Domain\Money;

class RecordOutcomeService
{
    public function __construct(
        private JournalRepository $journalRepository,
        private CategoryRepository $categoryRepository,
        private OutcomeAvailabilityService $availabilityService,
        private string $mediaDir,
    )
    {}

    public function record(OutcomeDTO $outcomeData): void
    {
        if (!$category = $this->categoryRepository->findById($outcomeData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        $id = Uuid::generate();

        foreach ($outcomeData->media as $key => $file) {
            $file->move($this->mediaDir, "{$id}_$key.{$file->guessExtension()}");
        }

        $outcome = new Outcome(
            id: $id,
            amount: Money::fromFloat($outcomeData->amount),
            description: $outcomeData->description,
            category: $category,
            media: new Medias(...$outcomeData->media),
        );

        $this->availabilityService->check(
            $outcome,
            $this->journalRepository->getCurrentBalance()
        );

        $this->journalRepository->recordOutcome($outcome);
    }
}
