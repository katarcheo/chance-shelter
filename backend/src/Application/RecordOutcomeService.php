<?php

namespace App\Application;

use App\Application\DTO\OutcomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\JournalRepository;
use App\Domain\Journal\Outcome;
use App\Domain\Media;
use App\Domain\Money;

class RecordOutcomeService
{
    public function __construct(
        private JournalRepository      $journalRepo,
        private CategoryRepository     $categoryRepo,
        private string                 $mediaDir,
    )
    {}

    public function record(OutcomeDTO $outcomeData): void
    {
        if (!$category = $this->categoryRepo->find($outcomeData->categoryId)) {
            throw new ApplicationException("Category not found");
        }

        $outcome = new Outcome(
            amount: Money::fromFloat($outcomeData->amount),
            category: $category,
            description: $outcomeData->description,
        );

        foreach ($outcomeData->media as $key => $file) {
            $file->move($this->mediaDir, "{$outcome->id()}_$key.{$file->guessExtension()}");
        }
        $outcome->addMedia(new Media(...$outcomeData->media));

        $balance = $this->journalRepo->lockCurrentBalance();
        $balance->applyOutcome($outcome);

        $this->journalRepo->recordOutcome($outcome, $balance);
    }
}
