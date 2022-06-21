<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\Get;

use Sezane\Util\Traits\ResponseTrait;

class GetResponse
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