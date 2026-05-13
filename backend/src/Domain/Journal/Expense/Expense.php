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

    public function __construct(
        #[ORM\Embedded]
        private Money $amount,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Category $category,
        #[ORM\Column(type: 'string', length: 255, nullable: true)]
        private ?string $description = null,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Journal $journal,
    )
    {
        $this->generateIdentity();
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
}
