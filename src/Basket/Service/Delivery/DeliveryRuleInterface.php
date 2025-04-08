<?php

namespace App\Basket\Service\Delivery;

interface DeliveryRuleInterface
{
    public function getDeliveryCost(float $total): float;
}
