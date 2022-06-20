<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Shop\Search;

use Sezane\Util\Traits\ViewModelTrait;

class ViewModel
{
    use ViewModelTrait;
    private array $shops = [];

    public function getShops(): array
    {
        return $this->shops;
    }

    public function setShops(array $shops): self
    {
        $this->shops = $shops;
        return $this;
    }
}