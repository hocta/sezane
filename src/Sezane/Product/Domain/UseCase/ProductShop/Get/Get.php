<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Get;

use Sezane\Product\Domain\Manager\ProductShopManager;
use Sezane\Shop\Domain\Manager\ShopManager;

class Get
{
    public function __construct(
        private ProductShopManager $productShopManager,
        private ShopManager $shopManager
    )
    {
    }

    public function execute(
        GetRequest            $request,
        GetPresenterInterface $presenter
    ): void
    {
        $response = new GetResponse();

        $products = $this->productShopManager->list(
            $request->getShopId(),
            $request->getPage(),
            $request->getOrderBy(),
            $request->getLimit()
        );

        if (empty($products)) {
            $response->setGlobalMessage('product.list.message.empty_product');
        } else {
            $response->setShop(
                $this->shopManager->findOneBy(['id' => $request->getShopId()])
            );
            $response->setGlobalMessage('product.list.message.success');
        }

        $response->setProducts($products);
        $presenter->present($response);
    }
}