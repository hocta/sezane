<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Get;

class GetRequest
{
    private int $page;
    private int $limit = 10;
    private ?int $shopId = null;
    private ?array $orderBy = null;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
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

    public function getOrderBy(): ?array
    {
        return $this->orderBy;
    }

    public function setOrderBy(?array $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }
}