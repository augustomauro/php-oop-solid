<?php

class Persona {
    public $nombre;

    public function saludo(){
        echo 'hola desde padre';
    }

    public function setNombre(string $nombre) {
        $this->nombre = strtolower($nombre);
    }

    public function getNombre() {
        return ucwords($this->nombre);
    }
}

trait A {
    public function saludo(){
        echo 'hola';
    }
}

trait B {
    public function saludo(){
        echo ' mundo';
    }
}

class Peruano extends Persona {
    use A, B {
        A::saludo insteadOf B;
    }
}

$peruano = new Peruano();
$peruano->saludo();  //'hola'