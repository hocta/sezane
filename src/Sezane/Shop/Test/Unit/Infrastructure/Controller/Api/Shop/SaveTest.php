<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Infrastructure\Controller\Api\Shop;

use Monolog\Test\TestCase;
use Sezane\Shop\Domain\UseCase\Shop\Save\Save;
use Sezane\Shop\Infrastructure\Controller\Api\Shop\Save as SaveController;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Save\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Save\JsonPresenter;
use Symfony\Component\HttpFoundation\Request;

class SaveTest extends TestCase
{
    public function test_shop_save_controller_invoke(): void
    {
        $content = '{
            "parameters": {
                "shopId": 23,
                "name": "Boutique test test 33334",
                "latitude": 48.23456789,
                "longitude": 2.44,
                "address": "123 rue pour une test"
            }
        }';

        $request = new Request([],[],[],[],[],[],$content);
        $presenter = $this->createMock(JsonPresenter::class);
        $viewRender = $this->createMock(JsonViewRender::class);

        $ucSave = $this->createMock(Save::class);
        $ucSave
            ->expects($this->once())
            ->method('execute');

        $viewRender
            ->expects($this->once())
            ->method('generateView');

        $presenter
            ->expects($this->once())
            ->method('getViewModel');

        $saveController = new SaveController(
            $presenter,
            $viewRender,
            $ucSave
        );

        $saveController($request);
    }
}