<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Save;

class saveRequest
{
    private ?int $productShopId = null;
    private ?int $productId = null;
    private ?int $shopId = null;
    private int $quantity = 0;

    public function getProductShopId(): ?int
    {
        return $this->productShopId;
    }

    public function setProductShopId(?int $productShopId): self
    {
        $this->productShopId = $productShopId;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(?int $shopId): self
    {
        $this->shopId = $shopId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        if($quantity) {
            $this->quantity = $quantity;
        }
        return $this;
    }
}