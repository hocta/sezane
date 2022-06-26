<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Save;

use Sezane\Product\Domain\Manager\ProductManager;
use Sezane\Product\Domain\Manager\ProductShopManager;
use Sezane\Product\Domain\Model\ProductShop;
use Sezane\Shop\Domain\Manager\ShopManager;

class Save
{
    public function __construct(
        private ProductShopManager $productShopManager,
        private ProductManager     $productManager,
        private ShopManager        $shopManager
    )
    {
    }

    public function execute(
        saveRequest            $request,
        SavePresenterInterface $presenter
    ): void
    {
        $response = new SaveResponse();

        $productShopId = $request->getProductShopId();
        $productId = $request->getProductId();
        $shopId = $request->getShopId();
        $quantity = $request->getQuantity();

        $product = $this->productManager->findOneBy(['id' => $productId]);
        $shop = $this->shopManager->findOneBy(['id' => $shopId]);

        if (!empty($product) && !empty($shop)) {
            $productShop = new ProductShop();
            $productShop
                ->setId($productShopId)
                ->setProduct($product)
                ->setShop($shop)
                ->setNumberStock($quantity);

            $productShopId = $this->productShopManager->save($productShop);
        }

        if ($shop === null) {
            $response->addCustomErrors('productshop.add.message.shop_not_exist');
        }

        if ($product === null) {
            $response->addCustomErrors('productshop.add.message.product_not_exist');
        }

        if ($productShopId === null) {
            $response->setGlobalMessage('productshop.add.message.error');
            $response->addCustomErrors('productshop.add.error_add');
        } elseif (!$productShopId) {
            $response->setGlobalMessage('productshop.add.message.error');
            $response->addCustomErrors('productshop.add.error_duplicate');
        } else {
            $response->setGlobalMessage('productshop.add.message.success');
        }

        $response
            ->setProduct($product)
            ->setShop($shop)
            ->setProductShopId($productShopId)
            ->setQuantity($quantity);

        $presenter->present($response);
    }
}