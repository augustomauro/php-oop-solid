<?php

namespace Application\UseCase;

use Application\Port\UserRepositoryInterface;
use Domain\Model\User;

class RegisterUserUseCase {
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(string $name, string $email): void {
        $user = new User(uniqid(), $name, $email);
        $this->repository->save($user);
    }
}
