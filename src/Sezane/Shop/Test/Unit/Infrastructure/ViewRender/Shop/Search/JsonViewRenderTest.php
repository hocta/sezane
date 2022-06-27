<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Infrastructure\ViewRender\Shop\Search;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Search\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Search\ViewModel;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonViewRenderTest extends TestCase
{
    use ShopTrait;

    public function test_shop_search_viewrender(): void
    {
        $shops = $this->getShops();

        $viewRender = new JsonViewRender();
        $viewModel = (new ViewModel())
            ->setShops($shops);

        $return = $viewRender->generateView($viewModel);

        $this->assertInstanceOf(JsonResponse::class, $return);

        $json = json_decode($return->getContent());
        $result = json_encode($json->result->shops);
        $expected = json_encode($shops);

        $this->assertEquals($expected, $result);
    }
}