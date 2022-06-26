<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Stock;

class GetRequest
{
    private int $productId;
    private array $shopsId = [];

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getShopsId(): array
    {
        return $this->shopsId;
    }

    public function setShopsId(array $shopsId): self
    {
        $this->shopsId = $shopsId;
        return $this;
    }
}