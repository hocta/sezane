<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\Get;

use Sezane\Product\Domain\Manager\ProductManager;

class Get
{
    public function __construct(
        private ProductManager $productManager
    )
    {
    }

    public function execute(
        GetRequest            $request,
        GetPresenterInterface $presenter
    ): void
    {
        $response = new GetResponse();

        $page = $request->getPage();
        $shopId = $request->getShopId();
        $orderBy = [
            'shop_id' => 'ASC',
            'product_id' => 'ASC'
        ];

        $products = $this->productManager->list($shopId, $page, $orderBy);

        $response->setProducts($products);
        $presenter->present($response);
    }
}