<?php

namespace App\Application\Exceptions;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class DTOException extends ApplicationException
{
    readonly public ConstraintViolationListInterface $violations;

    public function setViolations(ConstraintViolationListInterface $violations): self
    {
        $this->violations = $violations;

        return $this;
    }
}
