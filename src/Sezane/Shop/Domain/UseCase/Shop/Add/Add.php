<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Add;

use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\Model\Shop;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Add
{
    public function __construct(
        private ValidatorInterface $validator,
        private ShopManager $shopManager
    )
    {
    }

    public function execute(
        AddRequest            $request,
        AddPresenterInterface $presenter
    ): void
    {
        $response = new AddResponse();

        $shop = new Shop();
        $shop
            ->setName($request->getName())
            ->setLatitude($request->getLatitude())
            ->setLongitude($request->getLongitude())
            ->setAddress($request->getAddress());

        $errors = $this->validator->validate($shop, null, ['shop_add']);

        if ($errors->count() > 0) {
            $response->setGlobalMessage('shop.add.error');
            $response->setErrors($errors);
        } else {
            $this->shopManager->save($shop);
        }

        $presenter->present($response);
    }
}