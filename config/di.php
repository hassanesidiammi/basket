<?php

use App\Basket\Application\BasketApp;
use App\Basket\Service\Delivery\DeliveryRuleInterface;
use App\Basket\Service\Delivery\DeliveryRuleSet;
use App\Basket\Service\Offers\OfferInterface;
use App\Basket\Service\Offers\BuyR01GetOneHalfPrice;

return [
    DeliveryRuleInterface::class => DI\autowire(DeliveryRuleSet::class),

    OfferInterface::class => DI\autowire(BuyR01GetOneHalfPrice::class),
    'offers' => [
        DI\get(OfferInterface::class)
    ],

    BasketApp::class => DI\autowire(BasketApp::class)
        ->constructorParameter('offers', DI\get('offers'))
];
