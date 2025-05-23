Ref: https://www.youtube.com/watch?v=AdQp3_ow0vE&ab_channel=CodersFree

# TRAITS

### [\examples\traits1.php]
Veamos las siguientes clases:

```php
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

    class Peruano extends Persona {}

    class Aleman extends Persona {}

```

Ahora pensemos en que cada continente tiene su particularidad, entonces creamos 2 clases mas:

```php
<?php
    class LatinoAmericano {
        public function saludoLatinoamericano(){}
    }

    class Europeo {
        public function saludoEuropeo(){}
    }
```

Entonces ahora Peruano utilizaria LatinoAmericano y Aleman utilizaria Europeo.
Como esto no es posible en PHP porque solo admite herencia simple, se tulizan los Traits.

En este caso la 2da clase Padre la definiremos no como clase sino como "trait":

```php
<?php
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
```

Ahora quedaria:

```php
<?php
    class Peruano extends Persona {
        use LatinoAmericano;
    }

    class Aleman extends Persona {
        use Europeo;
    }
```

Con esto podemos hacer herencia multiple, ya que Peruano extiende de una clase padre Persona 
con todos sus atributos y metodos y lo mismo con el uso del trait LatinoAmericano. 
En ambos consideramos estariamos heredando todo como si fuera una herencia multiple.

```php
<?php
    $peruano = new Peruano();
    $peruano->saludoLatinoamericano();  // "esto es un saludo LatinoAmericano"
```

Una de las principales caracteristicas entr una clase y un Trait es que este ultimo 
NO SE PUEDE INSTANCIAR.


### [\examples\traits2.php]
Veamos ahora los siguiente:

```php
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
    }

```

Nota: Observemos que tanto la clase padre como el Trait tienen el mismo metodo declarado.

    $peruano = new Peruano();
    $peruano->saludo(); //???

Cual saludo devolvera esto? El del Trait, osea el texto "hola desde trait".
Cualquier Trait que tenga un metodo llamado igual que en el padre, lo va a sobreescribir.

### [\examples\traits3.php]
Ahora agreguemos tambien un metodo saludo() a la clase hija:

```php
<?php
    class Peruano extends Persona {
        use LatinoAmericano;

        public function saludo(){
            echo 'hola desde hija';
        }
    }

    $peruano = new Peruano();
    $peruano->saludo(); //???
```

Que devolvera ahora saludo()? El metodo dentro de la clase hija, es decir el texto "hola desde hija".

Importante: tener en cuenta con la PRECEDENCIA.


### [\examples\traits4.php]
Ahora veamos como utilizar mas de un Trait:

```php
<?php

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

```


### [\examples\traits5.php]
Ahora que pasaria si ambos trait contiene el mismo metodo?

```php
<?php

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
        use A, B;
    }

```

A priori ambos trait entrarian en conflicto ya que tiene el mismo metodo saludo().

Fatal error: Trait method B::saludo has not been applied as Peruano::saludo, because of collision with A::saludo


### [\examples\traits6.php]
Se puede indicar cual de ambos metodos utilizar o dar prioridad por sobre el otro, pero debe
hacerse en la clase hija:

```php
<?php
    class Peruano extends Persona {
        use A, B {
            A::saludo insteadOf B;
        }
    }

    $peruano = new Peruano();
    $peruano->saludo();  //'hola'
```

Esto le dice a la clase hija que cuando llame al metodo saludo() lo haga al trait A en lugar de (insteadOf) B.
Esto soluciona los conflictos cuando los Trait comparten el mismo nombre de algun metodo.


### [\examples\traits7.php]
## Visibilidad sobre Traits:

Que pasaria si el metodo saludo() en un trait se encontrara protegido y queremos llamarlo?
Daria error al intentar llamarlo desde la clase hija, pero podemos deshabilitar temporalmente
esta proteccion a traves de la siguiente declaracion:

```php
<?php

    trait A {
        protected function saludo(){
            echo 'hola';
        }
    }

    class Peruano extends Persona {
        use A { saludo as public; }
    }

```


### [\examples\traits8.php]
## Traits compuestos:

```php
<?php

    trait A {
        public function decirHola(){
            echo 'hola';
        }
    }

    trait B {
        public function decirMundo(){
            echo ' mundo';
        }
    }

    trait C {
        use A, B;
    }

    class Peruano extends Persona {
        use C;
    }

    $peruano = new Peruano();
    $peruano->decirHola();  //'hola'
    $peruano->decirMundo(); //'mundo'

```

Es como si se encolaran los meotodos entre Traits.


### [\examples\traits9.php]
## Traits y Metodos Abstractos:

```php
<?php

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
    
```

Nota: el trait B define un metodo saludar() como contrato, y el trait C al utilizar el trait B
esta obligado a declararlo.

---