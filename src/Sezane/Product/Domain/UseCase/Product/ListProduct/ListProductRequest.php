<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\ListProduct;

class ListProductRequest
{
    private ?array $orderBy = null;
    private ?int $page = 1;
    private ?int $limit = 10;

    public function getOrderBy(): ?array
    {
        return $this->orderBy;
    }

    public function setOrderBy(?array $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        if ($page) {
            $this->page = $page;
        }

        return $this;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
}