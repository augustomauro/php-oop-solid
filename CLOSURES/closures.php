<?php

function myFunctionName() {
    echo 'myFunction';
}

myFunctionName();

echo '<br>';

// Closure

(
    function () {
        echo 'myAnonimousFunction';
    }
)();

echo '<br>';

// Uso de variables externas:

$ex_variable = 'Daily';
$second_ex_variable = 'Tuition';
$myFunction = function() {
    echo $ex_variable,$second_ex_variable;
    //returns two error notice, since the variables aren't defined.
};

$myFunction();

// Solucion a variables externas:

$myFunction = function() use($ex_variable,$second_ex_variable) {
    echo $ex_variable,$second_ex_variable;
};

$myFunction();

echo '<br>';

$suma = function($a, $b) {
    return $a + $b;
};

echo $suma(3, 4); // Imprime 7

echo '<br>';

$factor = 2;

$multiplicar = function($x) use ($factor) {
    return $x * $factor;
};

echo $multiplicar(5); // Imprime 10

echo '<br>';

//Ejemplo con callback tradicional
function procesar($callback) {
    echo $callback(10);
}

procesar(function($x) {
    return $x * 2;
}); // Imprime 20

echo '<br>';

// Ejemplo 1:
$numeros = [1, 2, 3, 4, 5];

$dobles = array_map(function($n) {
    return $n * 2;
}, $numeros);

print_r($dobles);
// Resultado: [2, 4, 6, 8, 10]

echo '<br>';

// Ejemplo 2:

$factor = 10;

$valores = [3, 1, 5, 2];

usort($valores, function($a, $b) use ($factor) {
    return ($a * $factor) <=> ($b * $factor); // Ordena multiplicando por $factor
});

print_r($valores);
// Resultado: [1, 2, 3, 5] (es lo mismo que ordenar normalmente, pero usando $factor interno)