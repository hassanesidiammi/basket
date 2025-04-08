<?php

use App\Basket\Application\BasketApp;
use App\Basket\Domain\Model\Basket;
use App\Basket\Domain\Model\Product;
use App\Basket\Service\Data\Catalog;
use App\Basket\Service\Delivery\DeliveryRuleSet;
use App\Basket\Service\Offers\BuyR01GetOneHalfPrice;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private Catalog $catalog;
    private BasketApp $basketApp;

    protected function setUp(): void
    {
        $this->catalog = new Catalog([
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ]);

        $offers = [new BuyR01GetOneHalfPrice()];
        $this->basketApp = new BasketApp(new DeliveryRuleSet(), $offers);
    }

    private function createBasket(array $codes): Basket
    {
        $basket = new Basket($this->catalog);
        foreach ($codes as $code) {
            $basket->add($code);
        }
        return $basket;
    }

    public function testBasketTotal_R01_R01_G01(): void
    {
        $basket = $this->createBasket(['R01', 'R01', 'G01']);
        $this->assertCount(3, $basket->getItems());
        $this->assertEquals(90.85, round($basket->total(), 2));
        $this->assertEquals(77.33, $this->basketApp->total($basket));
    }

    public function testBasketTotal_B01_G01(): void
    {
        $basket = $this->createBasket(['B01', 'G01']);
        $this->assertEquals(37.85, $this->basketApp->total($basket));
    }

    public function testBasketTotal_R01_R01(): void
    {
        $basket = $this->createBasket(['R01', 'R01']);
        $this->assertEquals(54.38, $this->basketApp->total($basket));
    }

    public function testBasketTotal_R01_G01(): void
    {
        $basket = $this->createBasket(['R01', 'G01']);
        $this->assertEquals(60.85, $this->basketApp->total($basket));
    }

    public function testBasketTotal_B01_B01_R01_R01_R01(): void
    {
        $basket = $this->createBasket(['B01', 'B01', 'R01', 'R01', 'R01']);
        $this->assertEquals(98.28, $this->basketApp->total($basket));
    }
}
