### 🧱 ¿Qué es la Arquitectura Hexagonal?
También conocida como Ports and Adapters, fue propuesta por Alistair Cockburn. La idea principal es separar el núcleo de la aplicación (la lógica de negocio) de las interacciones externas (como bases de datos, APIs, interfaces de usuario, etc.).

## 🎯 Objetivo:
Aislar el dominio (reglas de negocio) de la infraestructura. Así tu app es más mantenible, testeable y flexible.

## 🧩 ¿Cómo se organiza?
Imaginá un hexágono con estos componentes:

Dominio (Core): Lógica de negocio pura.

Aplicación (Use Cases): Casos de uso del sistema.

Puertos (Ports): Interfaces que define la aplicación para comunicarse con el mundo exterior.

Adaptadores (Adapters): Implementaciones concretas de los puertos (como bases de datos, web controllers, etc.).

## 📦 Estructura de carpetas típica

hexagonal-php/
├── src/
│   ├── Domain/
│   │   └── Model/
│   │       └── User.php
│   ├── Application/
│   │   ├── UseCase/
│   │   │   └── RegisterUserUseCase.php
│   │   └── Port/
│   │       └── UserRepositoryInterface.php
│   ├── Infrastructure/
│   │   ├── Adapter/
│   │   │   ├── Controller/
│   │   │   │   └── UserController.php
│   │   │   └── Persistence/
│   │   │       └── InMemoryUserRepository.php
├── public/
│   └── index.php


## 1. Dominio: User.php

```php
<?php
    // src/Domain/Model/User.php
    class User {
        public function __construct(
            public string $id,
            public string $name,
            public string $email
        ) {}
    }
```

## 2. Puerto de salida (Output Port): UserRepositoryInterface.php

```php
<?php
    // src/Application/Port/UserRepositoryInterface.php
    interface UserRepositoryInterface {
        public function save(User $user): void;
    }
```

## 3. Caso de uso: RegisterUserUseCase.php

```php
<?php
    // src/Application/UseCase/RegisterUserUseCase.php
    class RegisterUserUseCase {
        public function __construct(private UserRepositoryInterface $repository) {}

        public function execute(string $name, string $email): void {
            $user = new User(uniqid(), $name, $email);
            $this->repository->save($user);
        }
    }
```

## 4. Adaptador: implementación de repositorio

```php
<?php
    // src/Infrastructure/Adapter/Persistence/InMemoryUserRepository.php
    class InMemoryUserRepository implements UserRepositoryInterface {
        private array $users = [];

        public function save(User $user): void {
            $this->users[$user->id] = $user;
            echo "Usuario {$user->name} guardado.\n";
        }
    }
```

## 5. Adaptador: entrada (puerto de entrada), tipo Controller

```php
<?php
    // src/Infrastructure/Adapter/Controller/UserController.php
    class UserController {
        public function __construct(private RegisterUserUseCase $useCase) {}

        public function register(array $requestData): void {
            $this->useCase->execute($requestData['name'], $requestData['email']);
        }
    }
```

## 🧪 Main (simulación)

```php
<?php
    $repo = new InMemoryUserRepository();
    $useCase = new RegisterUserUseCase($repo);
    $controller = new UserController($useCase);

    $controller->register([
        'name' => 'Pablo',
        'email' => 'pablo@example.com'
    ]);
```


### ✅ Ventajas
Testeás el RegisterUserUseCase sin necesidad de tener una base de datos.

Podés cambiar el adaptador (por ejemplo, usar MySQL en lugar de memoria) sin tocar el core.

El dominio no tiene ni idea de qué framework usás.

---