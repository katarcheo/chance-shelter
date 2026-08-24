<?php

namespace App\Application;

use App\Application\Exceptions\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidateCommand
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
    }

    public function __invoke(object $data, string $baseMessage = ""): void
    {
        $violations = $this->validator->validate($data);

        if ($violations->count()) {
            throw new ValidationException($data, $violations);
        }
    }
}
