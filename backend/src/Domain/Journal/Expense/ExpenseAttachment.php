<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Ident;
use App\Domain\Media\MediaRef;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity]
final class ExpenseAttachment
{
    #[ORM\Column]
    private string $mediaRef;
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UUidType::NAME)]
        private Ident $id,
        MediaRef $ref,
        #[ORM\ManyToOne(targetEntity: Expense::class, inversedBy: 'attachments')]
        private Expense $expense,
    )
    {
        $this->mediaRef = $ref->key;
    }

    public function media(): MediaRef
    {
        return new MediaRef($this->mediaRef);
    }
}
