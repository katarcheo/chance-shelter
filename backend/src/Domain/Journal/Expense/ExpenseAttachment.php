<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Entity;
use App\Domain\Media\MediaRef;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class ExpenseAttachment extends Entity
{
    #[ORM\Column]
    private string $mediaRef;
    public function __construct(
        MediaRef $ref,
        #[ORM\ManyToOne(targetEntity: Expense::class, inversedBy: 'attachments')]
        private Expense $expense,
    )
    {
        $this->initializeIdentity();
        $this->mediaRef = $ref->key;
    }

    public function media(): MediaRef
    {
        return new MediaRef($this->mediaRef);
    }
}
