<?php

namespace Infrastructure\Adapter\Persistence;

use Application\Port\UserRepositoryInterface;
use Domain\Model\User;

class InMemoryUserRepository implements UserRepositoryInterface {
    private array $users = [];

    public function save(User $user): void {
        $this->users[$user->id] = $user;
        echo "Usuario {$user->name} guardado.\n";
    }
}
