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