<?php

class Persona {
    public $nombre;

    public function setNombre(string $nombre) {
        $this->nombre = strtolower($nombre);
    }

    public function getNombre() {
        return ucwords($this->nombre);
    }
}

trait LatinoAmericano {
    public function saludoLatinoamericano(){
        echo 'esto es un saludo LatinoAmericano';
    }
}

trait Europeo {
    public function saludoEuropeo(){
        echo 'esto es un saludo Europeo';
    }
}

class Peruano extends Persona {
    use LatinoAmericano;
}

class Aleman extends Persona {
    use Europeo;
}

$peruano = new Peruano();
$peruano->saludoLatinoamericano();

echo '<br>';

$europeo = new Aleman();
$europeo->saludoEuropeo();