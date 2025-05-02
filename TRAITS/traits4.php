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

trait hola {
    public function decirHola(){
        echo 'hola';
    }
}

trait mundo {
    public function decirMundo(){
        echo ' mundo';
    }
}

class Peruano extends Persona {
    use hola, mundo;

    public function saludo(){
        echo 'hola desde hija';
    }
}

$peruano = new Peruano();
$peruano->decirHola();  //'hola'
$peruano->decirMundo(); //'mundo'