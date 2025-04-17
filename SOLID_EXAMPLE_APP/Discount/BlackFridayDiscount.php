<?php

require_once 'DiscountStrategy.php';

class BlackFridayDiscount implements DiscountStrategy {
    public function apply($price) {
        return $price * 0.5;
    }
}