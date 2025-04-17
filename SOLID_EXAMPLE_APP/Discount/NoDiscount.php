<?php

require_once 'DiscountStrategy.php';

class NoDiscount implements DiscountStrategy {
    public function apply($price) {
        return $price;
    }
}