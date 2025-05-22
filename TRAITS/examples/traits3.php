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

trait LatinoAmericano {
    public function saludo(){
        echo 'hola desde trait';
    }
}

class Peruano extends Persona {
    use LatinoAmericano;

    public function saludo(){
        echo 'hola desde hija';
    }
}

$peruano = new Peruano();
$peruano->saludo(); //???