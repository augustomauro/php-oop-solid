<?php

namespace Application\Port;

use Domain\Model\User;

interface UserRepositoryInterface {
    public function save(User $user): void;
}
