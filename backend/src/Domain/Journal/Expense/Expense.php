<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Category\Category;
use App\Domain\Ident;
use App\Domain\Journal\Balance;
use App\Domain\Media\MediaList;
use App\Domain\Media\MediaRef;
use App\Domain\Money;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity]
final class Expense
{
    #[ORM\OneToMany(targetEntity: ExpenseAttachment::class, mappedBy: 'expense', cascade: ['persist', 'remove'])]
    private Collection $attachments;
    #[ORM\Column]
    private \DateTimeImmutable $receivedAt;

    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UUidType::NAME)]
        private Ident $id,
        #[ORM\Embedded]
        private Money      $amount,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Category   $category,
        #[ORM\ManyToOne(inversedBy: 'expenses')]
        private Balance    $balance,
        \DateTimeImmutable $receivedAt,
        #[ORM\Column(type: 'string', length: 255, nullable: true)]
        private ?string    $description = null,
    )
    {
        $this->attachments = new ArrayCollection();
        $this->receivedAt = $receivedAt->setTime(
            $receivedAt->format('H'),
            $receivedAt->format('i'),
            $receivedAt->format('s'),
            0
        );
    }

    public function attachMedia(MediaRef $media): void
    {
        $this->attachments[] = new ExpenseAttachment(Ident::new(), $media, $this);
    }

    public function detachMedia(MediaRef $media): void
    {
        if (!$this->attachments->count()) {
            throw new ExpenseDoesNotHaveMediaException();
        }

        $found = $this->attachments->findFirst(
            fn(ExpenseAttachment $attachment) => $attachment->media()->key === $media->key,
        );

        if (is_null($found)) {
            throw new MediaIsNotExistInExpenseException($media->key);
        }

        $this->attachments->removeElement($found);
    }

    public function getAttachedMedia(): MediaList
    {
        $medias = $this
            ->attachments
            ->map(fn(ExpenseAttachment $attachment) => $attachment->media())
            ->toArray();

        return new MediaList(...$medias);
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
