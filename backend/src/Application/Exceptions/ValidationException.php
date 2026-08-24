<?php

namespace App\Application\Exceptions;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends ApplicationException
{
    readonly public ConstraintViolationListInterface $violations;
    public function __construct(string $message, ConstraintViolationListInterface $violations)
    {
        parent::__construct($message);
        $this->violations = $violations;
    }
}
