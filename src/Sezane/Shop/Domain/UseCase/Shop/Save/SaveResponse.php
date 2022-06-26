<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Save;

use Sezane\Shop\Domain\Model\Shop;
use Sezane\Util\Traits\ResponseTrait;

class SaveResponse
{
    use ResponseTrait;

    private ?Shop $shop = null;

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