<?php

namespace App\Basket\Service\Data;

use App\Basket\Domain\Model\Product;

class Catalog
{
    private array $products = [];

    public function __construct(array $products)
    {
        foreach ($products as $product) {
            $this->products[$product->code] = $product;
        }
    }

    public function get(string $code): Product
    {
        if (!isset($this->products[$code])) {
            throw new \InvalidArgumentException("Product NOT found: $code");
        }
        return $this->products[$code];
    }
}
