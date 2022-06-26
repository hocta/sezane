<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Get;

use Sezane\Shop\Domain\Model\Shop;
use Sezane\Util\Traits\ResponseTrait;

class GetResponse
{
    use ResponseTrait;

    private ?array $products = null;
    private ?Shop $shop = null;

    public function getProducts(): ?array
    {
        return $this->products;
    }

    public function setProducts(?array $products): self
    {
        $this->products = $products;
        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;
        return $this;
    }
}