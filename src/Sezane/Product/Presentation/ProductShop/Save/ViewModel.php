<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\ProductShop\Save;

use Sezane\Product\Domain\Model\Product;
use Sezane\Shop\Domain\Model\Shop;
use Sezane\Util\Traits\ViewModelTrait;

class ViewModel
{
    use ViewModelTrait;

    private ?Product $product = null;
    private ?Shop $shop;
    private ?int $productShopId = null;
    private ?int $quantity = null;

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
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

    public function getProductShopId(): ?int
    {
        return $this->productShopId;
    }

    public function setProductShopId(?int $productShopId): self
    {
        $this->productShopId = $productShopId;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}