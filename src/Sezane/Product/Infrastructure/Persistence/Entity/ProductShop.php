<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Persistence\Entity;

use Sezane\Shop\Infrastructure\Persistence\Entity\Shop;

class ProductShop
{
    private int $id;
    private int $numberStock = 0;

    private Product $product;
    private Shop $shop;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNumberStock(): int
    {
        return $this->numberStock;
    }

    public function setNumberStock(int $numberStock): self
    {
        $this->numberStock = $numberStock;
        return $this;
    }

    public function getShop(): Shop
    {
        return $this->shop;
    }

    public function setShop(Shop $shop): self
    {
        $this->shop = $shop;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }
}