<?php

namespace Infrastructure\Adapter\Controller;

use Application\UseCase\RegisterUserUseCase;

class UserController {
    public function __construct(private RegisterUserUseCase $useCase) {}

    public function register(array $requestData): void {
        $this->useCase->execute($requestData['name'], $requestData['email']);
    }
}
