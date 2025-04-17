<?php

/*
🧱 L - Liskov Substitution Principle (LSP)
Las subclases deben ser sustituibles por sus clases base. 
*/

// ❌ Ejemplo incorrecto:
class Bird {
    public function fly() {
        // volar
    }
}

class Penguin extends Bird {
    public function fly() {
        throw new Exception("¡Los pingüinos no vuelan!");
    }
}

// Llamar fly() en una instancia de Penguin rompe la expectativa del contrato de la clase base.

// ✅ Ejemplo correcto:
interface Bird {
    public function makeSound();
}

interface FlyingBird extends Bird {
    public function fly();
}

class Sparrow implements FlyingBird {
    public function makeSound() {
        echo "Pío pío";
    }

    public function fly() {
        echo "Volando...";
    }
}

class Penguin implements Bird {
    public function makeSound() {
        echo "Cuac";
    }
}

// Aquí se hace una separación de capacidades mediante interfaces.
