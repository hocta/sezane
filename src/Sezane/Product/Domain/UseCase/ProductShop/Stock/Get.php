<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Stock;

use Sezane\Product\Domain\Manager\ProductManager;
use Sezane\Product\Domain\Manager\ProductShopManager;

class Get
{
    public function __construct(
        private ProductShopManager $productShopManager,
        private ProductManager     $productManager
    )
    {
    }

    public function execute(
        GetRequest            $request,
        GetPresenterInterface $presenter
    ): void
    {
        $response = new GetResponse();

        $productId = $request->getProductId();
        $shopsId = $request->getShopsId();

        $product = $this->productManager->findOneBy(['id' => $productId]);
        $productStockShops = $this->productShopManager->getProductStockByShop($productId, $shopsId);

        if (!empty($productStockShops)) {
            $response
                ->setProduct($product)
                ->setProductShops($productStockShops);
            $response->setGlobalMessage('productshop.stock.success');
        } else {
            $response->setGlobalMessage('productshop.stock.empty_stock');
        }

        $presenter->present($response);
    }
}