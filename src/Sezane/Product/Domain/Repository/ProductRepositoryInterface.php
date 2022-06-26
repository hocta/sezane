<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Repository;

use Sezane\Product\Domain\Model\Product;

interface ProductRepositoryInterface
{
    public function findOneBy(array $criteria, ?array $orderBy = null): ?Product;

    public function list(int $page, ?array $orderBy, ?int $limit = null): array;
}