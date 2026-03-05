<?php

namespace App\Application;

use App\Application\DTO\OutcomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\JournalRepository;
use App\Domain\Journal\Outcome;
use App\Domain\Medias;
use App\Domain\Money;

class RecordOutcomeService
{
    public function __construct(
        private JournalRepository         $journalRepo,
        private CategoryRepository        $categoryRepo,
        private string                    $mediaDir,
    )
    {}

    public function record(OutcomeDTO $outcomeData): void
    {
        if (!$category = $this->categoryRepo->findById($outcomeData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        $id = Uuid::generate();

        foreach ($outcomeData->media as $key => $file) {
            $file->move($this->mediaDir, "{$id}_$key.{$file->guessExtension()}");
        }

        $outcome = new Outcome(
            id: $id,
            amount: Money::fromFloat($outcomeData->amount),
            category: $category,
            media: new Medias(...$outcomeData->media),
            description: $outcomeData->description,
        );

        $balance = $this->journalRepo->lockCurrentBalance();
        $balance->applyOutcome($outcome);

        $this->journalRepo->recordOutcome($outcome, $balance);
    }
}
