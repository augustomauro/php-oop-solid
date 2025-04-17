<?php

require_once 'ProductRepositoryInterface.php';
require_once 'Product.php';

class MySQLProductRepository implements ProductRepositoryInterface {
    public function save(Product $product) {
        // Simulando guardar en DB
        echo "Guardado en base de datos: " . $product->getName() . "<br>";
    }
}