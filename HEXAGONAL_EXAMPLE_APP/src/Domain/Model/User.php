<?php

namespace Domain\Model;

class User {
    public function __construct(
        public string $id,
        public string $name,
        public string $email
    ) {}
}
