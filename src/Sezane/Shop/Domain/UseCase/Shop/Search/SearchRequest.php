<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Search;

class SearchRequest
{
    private string $name;
    private ?float $latitude = null;
    private ?float $longitude = null;
    private ?int $distance = null;
    private int $page;

    public function getName(): string
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

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = floatval($latitude);
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = floatval($longitude);
        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?string $distance): self
    {
        $this->distance = intval($distance);
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }
}