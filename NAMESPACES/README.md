# NAMESPACES

Los espacios de nombres en PHP son un mecanismo diseñado para evitar las colisiones
de nombres.

En el mundo de PHP, los espacios de nombres estan diseñados para solucionar 
dos problemas con clases o funciones:

1. El conflicto de nombres entre el codigo que se crea y el que existe internamente en PHP
o en bibliotecas de terceros.

2. La capacidad de abreviar Nombres_Extra_Largos, mejorando la legibilidad del codigo fuente.

Los namespaces de PHP unicamente cubren los siguientes elementos PHP:

- Clases
- Interfaces
- Traits
- Funciones
- Constantes declaradas con const pero no con define


### Ejemplos:

App\Clases\claseA.php:

    <?php

    class claseA {
        //
    }

App\Clases\claseB.php:

    <?php

    class claseB {
        //
    }

App\Otros\claseA.php:

    <?php

    class claseA {
        //
    }

index.php:

    <?php

    require_once ('App\Clases\claseA.php');
    require_once ('App\Clases\claseB.php');
    require_once ('App\Otros\claseA.php');

    $claseA = new claseA();

Esto dara un error ya que se incluyo la misma claseA 2 veces.

Para solucionarlo, declareremos a traves de namespace:

App\Clases\claseA.php:

        <?php

        namespace App\Clases;

        class claseA {
            //
        }

App\Clases\claseB.php:

    <?php

    namespace App\Clases;

    class claseB {
        //
    }

App\Otros\claseA.php:

    <?php

    namespace App\Otros;

    class claseA {
        //
    }

index.php:

    <?php

    require_once ('App\Clases\claseA.php');
    require_once ('App\Clases\claseB.php');
    require_once ('App\Otros\claseA.php');

    $claseA = new App\Clases\claseA();

Con esto solucionamos el problema de que haya 2 clases con el mismo nombre ya que provienen
de namespaces distintos o de distintas rutas.

Otra forma de instanciar la claseA puede ser:

index.php:

    <?php

    require_once ('App\Clases\claseA.php');
    require_once ('App\Clases\claseB.php');
    require_once ('App\Otros\claseA.php');

    use App\Clases\claseA as claseA;
    use App\Otros\claseA as otraClaseA;

    $claseA = new claseA();
    $otraClaseA = new otraClaseA();

---