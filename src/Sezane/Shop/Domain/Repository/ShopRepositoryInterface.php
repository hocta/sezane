<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Repository;

use Sezane\Shop\Domain\Model\Shop;

interface ShopRepositoryInterface
{
    public function save(Shop $shop): ?Shop;

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Shop;

    public function searchByName(array $criteria, int $page = 1, array $orderBy = [], ?int $limit = null): array;

    public function searchByIds(array $shopsId): array;
}