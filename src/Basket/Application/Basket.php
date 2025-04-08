<?php

namespace App\Basket\Application;

use App\Basket\Service\Data\Catalog;
use App\Basket\Service\Delivery\DeliveryRuleInterface;

class Basket implements BasketInterface
{
    /**
     * @var Product[]
     */
    private array $items = [];

    public function __construct(
        private Catalog $catalog,
        private DeliveryRuleInterface $deliveryRule,
        private array $offers = [],
    ) {
    }

    public function add(string $productCode): self
    {
        $this->items[] = $this->catalog->get($productCode);
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function total(): float
    {
        $items = $this->getItems();

        $total = array_sum(array_map(fn($p) => $p->price, $items));
        $discount = array_sum(array_map(fn($offer) => $offer->apply($items), $this->offers));

        $delivery = $this->deliveryRule->getDeliveryCost($total - $discount);

        return round($total - $discount + $delivery, 2);
    }
}
