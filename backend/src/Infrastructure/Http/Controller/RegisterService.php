<?php

namespace App\Infrastructure\Http\Controller;

use App\Infrastructure\Http\Controller\DTO\RegisterUserDTO;
use App\Infrastructure\Security\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService
{
    public function __construct(
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $em,
    )
    {}

    public function user(RegisterUserDTO $userData): User
    {
        $errors = $this->validator->validate($userData);

        if ($errors->count() > 0) {
            throw new \Exception($errors[0]->getMessage());
        }

        if ($userData->password !== $userData->passwordRepeat) {
            throw new \Exception('Passwords do not match');
        }

        $user = new User();
        $user->setUsername($userData->username);

        $password = $this->hasher->hashPassword($user, $userData->password);
        $user->setPassword($password);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
