<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Product\Domain\Manager;

use Sezane\Product\Domain\Model\Product;
use Sezane\Product\Domain\Repository\ProductRepositoryInterface;

class ProductManager
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function save(Product $product): void{
        $this->productRepository->save($product);
    }

    public function list(?int $shopId, int $page = 1, array $orderBy = []): array
    {
        return $this->productRepository->list($shopId, $page, $orderBy);
    }
}