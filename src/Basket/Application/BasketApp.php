<?php

namespace App\Basket\Application;

use App\Basket\Domain\Model\Basket;
use App\Basket\Service\Delivery\DeliveryRuleInterface;
use App\Basket\Service\Offers\OfferInterface;

class BasketApp
{
    /** @param OfferInterface[] $offers */
    public function __construct(
        private DeliveryRuleInterface $delivery,
        private array $offers = [],
    ) {
    }

    public function total(Basket $basket): float
    {
        $items = $basket->getItems();
        $total = $basket->total();
        $discount = array_sum(array_map(fn($offer) => $offer->apply($items), $this->offers));
        $deliveryCost = $this->delivery->getDeliveryCost($total - $discount);
        return round($total - $discount + $deliveryCost, 2);
    }
}
