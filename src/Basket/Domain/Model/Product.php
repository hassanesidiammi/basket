<?php

namespace App\Basket\Domain\Model;

class Product
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly float $price
    ) {
    }
}
