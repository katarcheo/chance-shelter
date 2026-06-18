<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Category\Category;
use App\Domain\Entity;
use App\Domain\Journal\Journal;
use App\Domain\Money;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Expense extends Entity
{
    #[ORM\Column(type: 'json')]
    private array $media = [];
    #[ORM\Column]
    private \DateTimeImmutable $receivedAt;

    public function __construct(
        #[ORM\Embedded]
        private Money $amount,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Category $category,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Journal $journal,
        \DateTimeImmutable $receivedAt,
        #[ORM\Column(type: 'string', length: 255, nullable: true)]
        private ?string $description = null,
    )
    {
        $this->generateIdentity();
        $this->receivedAt = $receivedAt->setTime(
            $receivedAt->format('H'),
            $receivedAt->format('i'),
            $receivedAt->format('s'),
            0
        );
    }

    public function attachMedia(ExpenseMedia $media): void
    {
        $this->media[] = $media->path;
    }

    public function detachMedia(ExpenseMedia $media): void
    {
        if (!count($this->media)) {
            throw new ExpenseDoesNotHaveMediaException();
        }

        $index = array_find_key($this->media, fn(string $path) => $media->path === $path);

        if (is_null($index)) {
            throw new MediaIsNotExistInExpenseException($media->path);
        }

        unset($this->media[$index]);
    }

    public function getAttachedMedia(): ExpenseMediaList
    {
        $medias = array_map(fn(string $path) => new ExpenseMedia($path), $this->media);
        return new ExpenseMediaList(...$medias);
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
