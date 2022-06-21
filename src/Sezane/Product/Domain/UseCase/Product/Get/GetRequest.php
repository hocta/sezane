<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\Get;

class GetRequest
{
    private int $page;
    private ?int $shopId = null;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(?int $shopId): self
    {
        $this->shopId = $shopId;
        return $this;
    }
}