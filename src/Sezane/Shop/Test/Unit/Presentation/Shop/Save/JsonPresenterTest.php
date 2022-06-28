<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Presentation\Shop\Save;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Domain\UseCase\Shop\Save\SaveResponse;
use Sezane\Shop\Presentation\Shop\Save\JsonPresenter;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;

class JsonPresenterTest extends TestCase
{
    use ShopTrait;

    public function test_shop_save_presenter_present(): void
    {
        $shop = $this->getShop();
        $response = new SaveResponse();
        $response
            ->setGlobalMessage('message_global')
            ->setShop($shop)
            ->addCustomErrors('message_custom');

        $presenter = new JsonPresenter();
        $presenter->present($response);

        $this->assertEquals(
            $shop,
            $presenter->getViewModel()->getShop()
        );

        $this->assertEquals(
            'message_global',
            $presenter->getViewModel()->getGlobalMessage()
        );

        $this->assertEquals(
            'message_custom',
            $presenter->getViewModel()->getCustomErrors()[0]
        );
    }
}