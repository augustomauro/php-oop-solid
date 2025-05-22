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
    public function decirHola(){
        echo 'hola';
    }
}

trait B {
    public function decirMundo(){
        echo ' mundo';
    }

    abstract public function saludar();
}

trait C {
    use A, B;

    public function saludar(){
        $this->decirHola();
        $this->decirMundo();
    }
}

class Peruano extends Persona {
    use C;
}

$peruano = new Peruano();
$peruano->saludar();  //'hola mundo'