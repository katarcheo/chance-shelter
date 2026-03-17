<?php

namespace App\Application;

use App\Application\DTO\OutcomeDTO;
use App\Application\Exceptions\ApplicationException;
use App\Domain\Category\CategoryRepository;
use App\Domain\Journal\JournalRepository;
use App\Domain\Journal\Outcome;
use App\Domain\Media;
use App\Domain\Money;
use Doctrine\ORM\EntityManagerInterface;

class RecordOutcomeService
{
    public function __construct(
        private JournalRepository      $journalRepo,
        private CategoryRepository     $categoryRepo,
        private EntityManagerInterface $em,
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

        $this->em->persist($outcome);
        $this->em->persist($balance);

        $balance->applyOutcome($outcome);
        $this->em->flush();
    }
}
