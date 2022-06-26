<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Stock;

use Sezane\Product\Domain\Model\Product;
use Sezane\Util\Traits\ResponseTrait;

class GetResponse
{
    use ResponseTrait;

    private array $productShops = [];
    private ?Product $product = null;

    public function getProductShops(): array
    {
        return $this->productShops;
    }

    public function setProductShops(array $productShops): self
    {
        $this->productShops = $productShops;
        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }
}