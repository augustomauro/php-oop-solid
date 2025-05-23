### 🧱 📦 Caso: Gestión de Productos
Queremos:

Crear productos

Guardarlos en una base de datos

Aplicar descuentos con estrategias

Mostrar el producto en HTML

Aplicamos SOLID al dividir responsabilidades y abstraer dependencias.

### 🗂️ Estructura de carpetas

/ProductApp
│
├── Product.php
├── Discount/
│   ├── DiscountStrategy.php
│   ├── NoDiscount.php
│   ├── BlackFridayDiscount.php
│
├── Repository/
│   ├── ProductRepositoryInterface.php
│   ├── MySQLProductRepository.php
│
├── Service/
│   └── ProductService.php
│
├── Renderer/
│   └── ProductRenderer.php
│
└── index.php

## 1. Product.php – la entidad (SRP)

```php
<?php

    class Product {
        private $name;
        private $price;

        public function __construct($name, $price) {
            $this->name  = $name;
            $this->price = $price;
        }

        public function getName() {
            return $this->name;
        }

        public function getPrice() {
            return $this->price;
        }
    }

```

## 2. Discount/DiscountStrategy.php – interfaz de descuento (OCP)

```php
<?php

    interface DiscountStrategy {
        public function apply($price);
    }

```

/*Discount/NoDiscount.php*/

```php
<?php

    require_once 'DiscountStrategy.php';

    class NoDiscount implements DiscountStrategy {
        public function apply($price) {
            return $price;
        }
    }

```

/*Discount/BlackFridayDiscount.php*/

```php
<?php

    require_once 'DiscountStrategy.php';

    class BlackFridayDiscount implements DiscountStrategy {
        public function apply($price) {
            return $price * 0.5;
        }
    }

```

## 3. Repository/ProductRepositoryInterface.php (DIP)

```php
<?php

    interface ProductRepositoryInterface {
        public function save(Product $product);
    }

```

/*Repository/MySQLProductRepository.php*/

```php
<?php

    require_once 'ProductRepositoryInterface.php';
    require_once 'Product.php';

    class MySQLProductRepository implements ProductRepositoryInterface {
        public function save(Product $product) {
            // Simulando guardar en DB
            echo "Guardado en base de datos: " . $product->getName() . "<br>";
        }
    }

```

## 4. Service/ProductService.php – usa inyección de dependencias (DIP + SRP)

```php
<?php

    require_once 'Repository/ProductRepositoryInterface.php';
    require_once 'Discount/DiscountStrategy.php';

    class ProductService {
        private $repository;
        private $discount;

        public function __construct(ProductRepositoryInterface $repo, DiscountStrategy $discount) {
            $this->repository = $repo;
            $this->discount   = $discount;
        }

        public function createProduct($name, $price) {
            $priceWithDiscount = $this->discount->apply($price);
            $product = new Product($name, $priceWithDiscount);
            $this->repository->save($product);
            return $product;
        }
    }

```

## 5. Renderer/ProductRenderer.php – salida HTML (SRP)

```php
<?php

    class ProductRenderer {
        public function render(Product $product) {
            echo "<h2>" . htmlspecialchars($product->getName()) . "</h2>";
            echo "<p>Precio: $" . number_format($product->getPrice(), 2) . "</p>";
        }
    }

```

## 6. index.php – ejecución (todo junto)

```php
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

```

### ✅ ¿Qué principios SOLID aplicamos?
Principio	Aplicación en el ejemplo
SRP	        Cada clase tiene una única responsabilidad (crear, guardar,         renderizar, aplicar descuentos)
OCP	        Se pueden agregar descuentos sin modificar lógica central
LSP	        Las estrategias de descuento respetan la interfaz base
ISP	        Usamos interfaces pequeñas (DiscountStrategy, ProductRepositoryInterface)
DIP	        ProductService depende de abstracciones, no de clases concretas

---