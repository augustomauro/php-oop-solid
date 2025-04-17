<?php

interface DiscountStrategy {
    public function apply($price);
}