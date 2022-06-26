<?php

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Shop\Save;

use Sezane\Shop\Domain\Model\Shop;
use Sezane\Util\Traits\ViewModelTrait;

class ViewModel
{
    use ViewModelTrait;

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