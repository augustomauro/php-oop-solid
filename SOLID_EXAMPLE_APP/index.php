<?php

require_once 'Product.php';
require_once 'Discount/NoDiscount.php';
require_once 'Discount/BlackFridayDiscount.php';
require_once 'Repository/MySQLProductRepository.php';
require_once 'Service/ProductService.php';
require_once 'Renderer/ProductRenderer.php';

// Puedes cambiar entre NoDiscount y BlackFridayDiscount
$discountStrategy = new BlackFridayDiscount();
$repository       = new MySQLProductRepository();
$service          = new ProductService($repository, $discountStrategy);

// Crear y guardar un producto
$product = $service->createProduct('Zapatillas Nike', 120.00);

// Renderizar HTML
$renderer = new ProductRenderer();
$renderer->render($product);