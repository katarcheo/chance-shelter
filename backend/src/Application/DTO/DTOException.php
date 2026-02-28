<?php

namespace App\Application\DTO;

use App\Application\Exceptions\ApplicationException;
use Symfony\Component\Validator\ConstraintViolationList;
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
