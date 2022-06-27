<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Manager\Save;

use Sezane\Shop\Domain\Model\Manager;
use Sezane\Util\Traits\ResponseTrait;

class SaveResponse
{
    use ResponseTrait;

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