<?php

// Dominio: User.php
class User {
    public function __construct(
        public string $id,
        public string $name,
        public string $email
    ) {}
}

// Puerto de salida: UserRepositoryInterface.php
interface UserRepositoryInterface {
    public function save(User $user): void;
}

// Caso de uso: RegisterUserUseCase.php
class RegisterUserUseCase {
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(string $name, string $email): void {
        $user = new User(uniqid(), $name, $email);
        $this->repository->save($user);
    }
}

// Adaptador de persistencia: InMemoryUserRepository.php
class InMemoryUserRepository implements UserRepositoryInterface {
    private array $users = [];

    public function save(User $user): void {
        $this->users[$user->id] = $user;
        echo "Usuario {$user->name} guardado.\n";
    }
}

// Adaptador de entrada: UserController.php
class UserController {
    public function __construct(private RegisterUserUseCase $useCase) {}

    public function register(array $requestData): void {
        $this->useCase->execute($requestData['name'], $requestData['email']);
    }
}

// Simulación (como un index.php)
$repo = new InMemoryUserRepository();
$useCase = new RegisterUserUseCase($repo);
$controller = new UserController($useCase);

// Supongamos que estos datos vienen de un request HTTP
$request = [
    'name' => 'Pablo',
    'email' => 'pablo@example.com'
];

$controller->register($request);
