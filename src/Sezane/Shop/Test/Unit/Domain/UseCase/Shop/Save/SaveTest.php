<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Domain\UseCase\Shop\Save;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\UseCase\Shop\Save\Save;
use Sezane\Shop\Domain\UseCase\Shop\Save\SaveRequest;
use Sezane\Shop\Presentation\Shop\Save\JsonPresenter;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SaveTest extends TestCase
{
    use ShopTrait;

    public function test_shop_save_usecase_execute(): void
    {
        $shop = $this->getShop();

        $saveRequest = new SaveRequest();
        $presenter = new JsonPresenter();

        $validator = $this->createMock(ValidatorInterface::class);
        $shopManager = $this->createMock(ShopManager::class);

        $saveRequest
            ->setShopId($shop->getId())
            ->setName($shop->getName())
            ->setLatitude($shop->getLatitude())
            ->setLongitude($shop->getLongitude())
            ->setAddress($shop->getAddress());

        $shopManager
            ->expects($this->once())
            ->method('findOneBy')
            ->with([
                'id' => $shop->getId(),
                'name' => $shop->getName()
            ])
            ->willReturn($shop);

        $shopManager
            ->expects($this->once())
            ->method('save')
            ->willReturn($shop);

        $validator
            ->expects($this->never())
            ->method('validate');

        $ucSave = new Save($validator, $shopManager);
        $ucSave->execute($saveRequest, $presenter);

        $this->assertEquals(
            $shop,
            $presenter->getViewModel()->getShop()
        );

        $this->assertEquals(
            'shop.save.update.message.success',
            $presenter->getViewModel()->getGlobalMessage()
        );

        $this->assertNull(
            $presenter->getViewModel()->getCustomErrors()
        );
    }
}