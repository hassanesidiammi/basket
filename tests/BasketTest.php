<?php

use App\Basket\Application\Basket;
use App\Basket\Domain\Model\Product;
use App\Basket\Service\Data\Catalog;
use App\Basket\Service\Delivery\DeliveryRuleSet;
use App\Basket\Service\Offers\BuyR01GetOneHalfPrice;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testBasketTotal(): void
    {
        $catalog = new Catalog([
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
        ]);

        $offers = [new BuyR01GetOneHalfPrice()];

        $basket = new Basket($catalog, new DeliveryRuleSet(), $offers);

        $basket->add('R01')->add('R01')->add('G01');

        // (32.95 + 32.95/2 + 24.95) + 2.95
        $this->assertEquals(77.33, $basket->total());
    }
}
