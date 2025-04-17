<?php

/*
🧱 D - Dependency Inversion Principle (DIP)
Depende de abstracciones, no de concreciones.
*/

// ❌ Ejemplo incorrecto:
class MySQLConnection {
    public function connect() {
        // conectar a MySQL
    }
}

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = new MySQLConnection();
    }
}

// ✅ Ejemplo correcto:
interface DBConnection {
    public function connect();
}

class MySQLConnection implements DBConnection {
    public function connect() {
        // conectar a MySQL
    }
}

class UserRepository {
    private $db;

    public function __construct(DBConnection $db) {
        $this->db = $db;
    }
}

// Inyección de dependencia:
$repo = new UserRepository(new MySQLConnection());

// Se inyecta una abstracción (DBConnection), y no una implementación concreta.
