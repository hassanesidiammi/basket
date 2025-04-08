<?php

namespace App\Basket\Service\Offers;

use App\Basket\Product;

interface OfferInterface
{
    /**
     * @param Product[] $items 
     */
    public function apply(array $items): float;
}
