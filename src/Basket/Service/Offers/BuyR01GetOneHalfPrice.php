<?php

namespace App\Basket\Service\Offers;

use App\Basket\Product;

class BuyR01GetOneHalfPrice implements OfferInterface
{
    /** @param Product[] $items */
    public function apply(array $items): float
    {
        $count = 0;
        $discount = 0;

        foreach ($items as $item) {
            if ($item->code === 'R01') {
                $count++;
                if (0 === $count % 2) {
                    $discount += ($item->price / 2);
                }
            }
        }

        return $discount;
    }
}
