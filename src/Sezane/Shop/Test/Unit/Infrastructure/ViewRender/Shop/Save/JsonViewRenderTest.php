<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Infrastructure\ViewRender\Shop\Save;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Domain\Model\Shop;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Save\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Save\ViewModel;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;
use Sezane\Util\Traits\JsonViewRenderTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRenderTest extends TestCase
{
    use ShopTrait;
    use JsonViewRenderTrait;

    public function test_viewrender_shop_save_generateView(): void
    {
        $shop = $this->getShop();

        $translator = $this->createMock(TranslatorInterface::class);

        $viewModel = new ViewModel();
        $viewModel
            ->setShop($shop)
            ->setGlobalMessage('fake_message');

        $viewRender = new JsonViewRender($translator);
        $result = $viewRender->generateView($viewModel);

        $this->assertInstanceOf(
            JsonResponse::class,
            $result
        );

        $json = json_decode($result->getContent());

        $this->assertEquals(
            $this->codeSuccess(),
            $json->result->code
        );

        $this->assertEquals(
            $this->getResultViewRender($shop),
            (array)$json->result->shop
        );
    }

    private function getResultViewRender(Shop $shop): array
    {
        return [
            'id' => $shop->getId(),
            'name' => $shop->getName(),
            'latitude' => $shop->getLatitude(),
            'longitude' => $shop->getLongitude(),
            'address' => $shop->getAddress(),
            'manager' => $shop->getManager()->getId(),
        ];
    }
}