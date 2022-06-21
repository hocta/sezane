<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Product\Presentation\Product\Get;

use Sezane\Util\Traits\ViewModelTrait;

class ViewModel
{
    use ViewModelTrait;

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