<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Search;

class SearchRequest
{
    private ?string $name = null;
    private ?float $latitude = null;
    private ?float $longitude = null;
    private ?int $distance = null;
    private ?int $page = null;
    private ?array $orderBy = null;
    private ?int $limit = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = floatval($latitude);
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = floatval($longitude);
        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;
        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
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