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
    protected function saludo(){
        echo 'hola';
    }
}

class Peruano extends Persona {
    use A { saludo as public; }
}

$peruano = new Peruano();
$peruano->saludo();  //'hola'