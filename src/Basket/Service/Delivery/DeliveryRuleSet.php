<?php

namespace App\Basket\Service\Delivery;

class DeliveryRuleSet implements DeliveryRuleInterface
{
    public function getDeliveryCost(float $subtotal): float
    {
        return match (true) {
            $subtotal < 50 => 4.95,
            $subtotal < 90 => 2.95,
            default => 0.0,
        };
    }
}
