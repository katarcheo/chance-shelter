<?php

namespace App\Infrastructure\Security;

use Symfony\Component\Validator\Constraints as Assert;

readonly class RegisterUserDTO
{
    public function __construct(
        #[Assert\Length(min: 2, max: 255)]
        #[Assert\Regex('/\w+/')]
        public string $username,
        #[Assert\Length(min: 8, max: 255)]
        public string $password,
        #[Assert\NotBlank]
        public string $passwordRepeat,
    )
    {}
}
