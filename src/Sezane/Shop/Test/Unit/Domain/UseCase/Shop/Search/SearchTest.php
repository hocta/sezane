<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Domain\UseCase\Shop\Search;

use PHPUnit\Framework\TestCase;
use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\UseCase\Shop\Search\Search;
use Sezane\Shop\Domain\UseCase\Shop\Search\SearchRequest;
use Sezane\Shop\Presentation\Shop\Search\JsonPresenter;
use Sezane\Shop\Test\Unit\Traits\ShopTrait;

class SearchTest extends TestCase
{
    use ShopTrait;

    public function test_shop_search_usecase_execute(): void
    {
        $presenter = new JsonPresenter();
        $request = new SearchRequest();
        $request
            ->setName('Boutique')
            ->setLatitude(48.0)
            ->setLongitude(2.5)
            ->setDistance(100)
            ->setPage(1)
            ->setOrderBy(['name' => 'ASC'])
            ->setLimit(10);

        $shopManager = $this->createMock(ShopManager::class);
        $shopManager
            ->method('searchByName')
            ->with(
                [
                    'name' => $request->getName(),
                    'latitude' => $request->getLatitude(),
                    'longitude' => $request->getLongitude(),
                    'distance' => $request->getDistance(),
                ],
                $request->getPage(),
                $request->getOrderBy(),
                $request->getLimit()
            )
            ->willReturn($this->getShops());

        $search = new Search($shopManager);
        $search->execute($request, $presenter);

        $this->assertEquals(
            $this->getShops(),
            $presenter->getViewModel()->getShops()
        );
    }
}