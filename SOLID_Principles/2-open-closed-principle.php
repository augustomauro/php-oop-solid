<?php

/*
🧱 O - Open/Closed Principle (OCP)
El software debe estar abierto para la extensión pero cerrado para la modificación.
*/

// ❌ Ejemplo incorrecto:
class Report {
    public function generate() {
        // generar el reporte
    }

    public function saveToFile($filename) {
        file_put_contents($filename, 'contenido');
    }

    public function sendEmail($email) {
        // lógica para enviar el correo
    }
}

// ✅ Ejemplo correcto:
interface DiscountStrategy {
    public function apply($price);
}

class BlackFridayDiscount implements DiscountStrategy {
    public function apply($price) {
        return $price * 0.5;
    }
}

class CyberMondayDiscount implements DiscountStrategy {
    public function apply($price) {
        return $price * 0.7;
    }
}

class NoDiscount implements DiscountStrategy {
    public function apply($price) {
        return $price;
    }
}

// Definicion:
function applyDiscount($price, DiscountStrategy $strategy) {
    return $strategy->apply($price);
}

// Uso:
$price = 100;
$discounted = applyDiscount($price, new BlackFridayDiscount());

// Ahora puedes agregar nuevos descuentos sin tocar la lógica existente.