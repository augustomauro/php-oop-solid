<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Infrastructure\Adapter\Controller\UserController;
use Infrastructure\Adapter\Persistence\InMemoryUserRepository;
use Application\UseCase\RegisterUserUseCase;

// Setup manual de dependencias (sin frameworks)
$repository = new InMemoryUserRepository();
$useCase = new RegisterUserUseCase($repository);
$controller = new UserController($useCase);

// Simulación de request
$request = [
    'name' => 'Pablo',
    'email' => 'pablo@example.com'
];

$controller->register($request);
