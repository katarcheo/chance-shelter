<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Ident;
use App\Domain\Media\MediaRef;
use App\Infrastructure\Doctrine\Types\IdentType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class ExpenseAttachment
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: IdentType::NAME)]
        private Ident $id,
        #[ORM\ManyToOne(targetEntity: Expense::class, inversedBy: 'attachments')]
        private Expense $expense,
        #[ORM\Embedded]
        private MediaRef $mediaRef,
    )
    {
    }

    public function id(): Ident
    {
        return $this->id;
    }

    public function media(): MediaRef
    {
        return new MediaRef($this->mediaRef);
    }
}
