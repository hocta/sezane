<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Presentation\Shop\Search;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Domain\UseCase\Shop\Search\SearchResponse;
use Sezane\Shop\Presentation\Shop\Search\JsonPresenter;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;

class JsonPresenterTest extends TestCase
{
    use ShopTrait;

    public function test_shop_search_with_shops(): void
    {
        $shops = $this->getShops();

        $presenter = new JsonPresenter();
        $response = (new SearchResponse())
            ->setGlobalMessage('List shops')
            ->setShops($shops);

        $presenter->present($response);
        $this->assertEquals(
            $shops,
            $presenter->getViewModel()->getShops()
        );
    }
}