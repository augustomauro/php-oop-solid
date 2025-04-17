<?php

class ProductRenderer {
    public function render(Product $product) {
        echo "<h2>" . htmlspecialchars($product->getName()) . "</h2>";
        echo "<p>Precio: $" . number_format($product->getPrice(), 2) . "</p>";
    }
}