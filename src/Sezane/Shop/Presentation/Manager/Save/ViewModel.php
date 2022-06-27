<?php

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Manager\Save;

use Sezane\Shop\Domain\Model\Manager;
use Sezane\Util\Traits\ViewModelTrait;

class ViewModel
{
    use ViewModelTrait;

    private ?Manager $manager = null;
    private ?array $shops = null;

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;
        return $this;
    }

    public function getShops(): ?array
    {
        return $this->shops;
    }

    public function setShops(?array $shops): self
    {
        $this->shops = $shops;
        return $this;
    }
}