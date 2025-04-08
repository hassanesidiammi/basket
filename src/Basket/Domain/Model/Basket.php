<?php

namespace App\Basket\Domain\Model;

use App\Basket\Service\Data\Catalog;

final class Basket
{
    /**
     * @var Product[]
     */
    private array $items = [];

    public function __construct(
        private Catalog $catalog,
    ) {
    }

    public function add(string $productCode): self
    {
        $this->items[] = $this->catalog->get($productCode);
        return $this;
    }

    /** @return Product[] */
    public function getItems(): array
    {
        return $this->items;
    }

    public function total(): float
    {
        return array_sum(array_map(fn($p) => $p->price, $this->items));
    }
}
