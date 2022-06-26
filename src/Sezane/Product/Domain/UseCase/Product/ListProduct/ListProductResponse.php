<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\ListProduct;

use Sezane\Util\Traits\ResponseTrait;

class ListProductResponse
{
    use ResponseTrait;

    private array $products = [];

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): self
    {
        $this->products = $products;
        return $this;
    }
}