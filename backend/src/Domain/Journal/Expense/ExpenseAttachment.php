<?php

namespace App\Domain\Journal\Expense;

use App\Domain\Entity;
use App\Domain\Media\MediaRef;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToOne;

final class ExpenseAttachment extends Entity
{
    public function __construct(
        #[Embedded]
        private MediaRef $ref,
        #[ManyToOne(targetEntity: Expense::class, inversedBy: 'attachments')]
        private Expense $expense,
    )
    {
        $this->generateIdentity();
    }

    public function media(): MediaRef
    {
        return $this->ref;
    }
}
