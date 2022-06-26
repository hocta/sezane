<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Save;

use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\Model\Shop;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Save
{
    public function __construct(
        private ValidatorInterface $validator,
        private ShopManager        $shopManager
    )
    {
    }

    public function execute(
        SaveRequest            $request,
        SavePresenterInterface $presenter
    ): void
    {
        $response = new SaveResponse();

        $shop = new Shop();
        $shop
            ->setId($request->getShopId())
            ->setName($request->getName())
            ->setLatitude($request->getLatitude())
            ->setLongitude($request->getLongitude())
            ->setAddress($request->getAddress());

        $shopCheck = null;

        if ($shop->getId()) {
            $shopCheck = $this->shopManager->findOneBy([
                'id' => $shop->getId(),
                'name' => $shop->getName()
            ]);
        }

        if ($shopCheck === null) {
            $errors = $this->validator->validate($shop, null, ['shop_add']);
        }

        if (!empty($errors) && $errors->count() > 0) {
            $response->setGlobalMessage('shop.add.error');
            $response->setErrors($errors);
        } else {
            if ($shop->getId()) {
                $response->setGlobalMessage('shop.save.update.message.success');
            } else {
                $response->setGlobalMessage('shop.save.add.message.success');
            }

            $saveShop = $this->shopManager->save($shop);
            $response->setShop($saveShop);
        }

        $presenter->present($response);
    }
}