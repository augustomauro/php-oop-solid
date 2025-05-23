# CLOSURES

✅ 1. Función anónima
    Una función anónima es una función sin nombre. 
    Se puede asignar a una variable y luego ejecutarse como una función normal.

```php
<?php
    $suma = function($a, $b) {
        return $a + $b;
    };

    echo $suma(3, 4); // Imprime 7
```

✅ 2. Closure
    Un Closure es una instancia de la clase Closure en PHP, que usualmente 
    es una función anónima. Su característica más interesante es que puede 
    capturar variables del entorno en el que fue definida, usando use().

```php
<?php
    $factor = 2;

    $multiplicar = function($x) use ($factor) {
        return $x * $factor;
    };

    echo $multiplicar(5); // Imprime 10
```

✅ 3. ¿Se parecen a los callbacks?
    Sí, son muy parecidos a los callbacks. En PHP, los callbacks pueden ser:

    El nombre de una función como string

    Un método de clase en array ([$objeto, 'metodo'])

    O una función anónima / closure

Ejemplo con callback tradicional:

```php
<?php
    function procesar($callback) {
        echo $callback(10);
    }

    procesar(function($x) {
        return $x * 2;
    }); // Imprime 20
```

-

### Otros ejemplos:

Funcion tradicional:

```php
<?php
    function myFunctionName() {
        echo 'myFunction';
    }
    myFunctionName();   // para llamarla
```

Version Anonima:

```php
<?php
    function () {
        echo 'myAnonimousFunction';
    }
```

Tambien puede declararse como:

```php
<?php
    $an_fun = function () {
        echo 'myAnonimousFunction';
    };
    $an_fn();   // para llamarla
```

Version Closure:

Como llamar a esta funcion entonces?

```php
<?php
    (
        function () {
            echo 'myAnonimousFunction';
        }
    )();
```

Los Closures pueden acceder al scope externo usando "use":

```php
<?php
    $ex_variable = 'Daily';
    $second_ex_variable = 'Tuition';
    $myFunction = function() {
        echo $ex_variable,$second_ex_variable;
        //returns two error notice, since the variables aren't defined.
    };

    $myFunction();
```

Usando "use"

```php
<?php
    $myFunction = function() use($ex_variable,$second_ex_variable) {
        echo $ex_variable,$second_ex_variable;
    };
```


Importante: A nivel callbacks (funciones de uso dentro de otras funciones) tambien se sigue la misma regla de una funcion anonima o closure para el uso de variables externas.


Aqui van dos ejemplos comunes donde se usan Closures como callbacks en funciones nativas  de PHP como array_map y usort.

🔹 Ejemplo 1: array_map con Closure

```php
<?php
    $numeros = [1, 2, 3, 4, 5];

    $dobles = array_map(function($n) {
        return $n * 2;
    }, $numeros);

    print_r($dobles);
    // Resultado: [2, 4, 6, 8, 10]
```

🔹 Ejemplo 2: usort con Closure y use()

```php
<?php
    $factor = 10;

    $valores = [3, 1, 5, 2];

    usort($valores, function($a, $b) use ($factor) {
        return ($a * $factor) <=> ($b * $factor); // Ordena multiplicando por $factor
    });

    print_r($valores);
    // Resultado: [1, 2, 3, 5] (es lo mismo que ordenar normalmente, pero usando $factor interno)
```

Conclusion: 
En este segundo ejemplo, aunque usort no necesita use($factor) para este caso, muestra cómo se puede capturar variables externas dentro de la función anónima. 
Eso es lo que hace que sea un Closure.


🔁 Comparación rápida
Concepto	    ¿Tiene nombre?	                    ¿Captura variables?	    ¿Es un callback válido?
Función anónima	❌ No	                            ✔️ Si (con use)	        ✔️ Sí
Closure	        ❌ No (es una instancia de Closure)	✔️ Sí	                ✔️ Sí
Callback	    ✔️/❌ (puede ser string o closure)	✔️ Si usa closure	    ✔️ Sí

---