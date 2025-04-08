<?php

namespace App\Basket\Application;

interface BasketInterface
{
    public function total(): float;
    public function add(string $productCode): self;
}
