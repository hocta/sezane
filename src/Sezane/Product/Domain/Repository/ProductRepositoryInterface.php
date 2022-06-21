<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Repository;

use Sezane\Product\Domain\Model\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
    public function list(?int $shopId, int $page = 1, array $orderBy = []): array;
}