<?php

/*
🧱 I - Interface Segregation Principle (ISP)
Los clientes no deberían verse forzados a depender de interfaces que no usan.
*/

// ❌ Ejemplo incorrecto:
interface Worker {
    public function work();
    public function eat();
}

class Robot implements Worker {
    public function work() {
        // trabajar
    }

    public function eat() {
        // ¿?
        throw new Exception("¡Los robots no comen!");
    }
}

// ✅ Ejemplo correcto:
interface Workable {
    public function work();
}

interface Eatable {
    public function eat();
}

class Human implements Workable, Eatable {
    public function work() {
        // trabajar
    }

    public function eat() {
        // comer
    }
}

class Robot implements Workable {
    public function work() {
        // trabajar
    }
}

// Separar en interfaces más pequeñas evita implementaciones incorrectas.
