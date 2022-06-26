<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\ListProduct;

use Sezane\Product\Domain\Manager\ProductManager;

class ListProduct
{
    public function __construct(
        private ProductManager $productManager
    )
    {
    }

    public function execute(
        ListProductRequest            $request,
        ListProductPresenterInterface $presenter
    ): void
    {
        $response = new ListProductResponse();

        $products = $this->productManager->list(
            $request->getPage(),
            $request->getOrderBy(),
            $request->getLimit()
        );

        if (!$products) {
            $response->setGlobalMessage('product.list.message.not_product');
        } else {
            $response->setGlobalMessage('product.list.message.success');
        }

        $response->setProducts($products);
        $presenter->present($response);
    }
}